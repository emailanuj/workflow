"use strict";

//var dragFlows =[];

var g2;
var points = [], g;

var bpmnEventDivider = function (bpmnElement, subElement, svg) {

    // console.log(bpmnElement);
    if (bpmnElement === "startEvent") {
        window.bpmnElement = null;
        starteventdevider(null, subElement, svg, d3.event.pageX, d3.event.pageY);
    } else if (bpmnElement === "endEvent") {
        window.bpmnElement = null;
        endeventdevider(null, subElement, svg, d3.event.pageX, d3.event.pageY);
    } else if (bpmnElement === "task") {
        window.bpmnElement = null;
        // var sampleSVG = svg;
        taskdevider(null, subElement, svg, d3.event.pageX, d3.event.pageY);
    } else if (bpmnElement === "gateway") {
        window.bpmnElement = null;
        gatewaydevider(null, subElement, svg, d3.event.pageX, d3.event.pageY);
    }
    else if (bpmnElement === "flow" || bpmnElement === "flowselect") {
        window.bpmnElement = null;
        flowcreator(null, subElement, svg, d3.event.pageX, d3.event.pageY);
    }

    console.log(window.selectedtextid);
    if (window.selectedtextid != null) {
        console.log(window.selectedtextid);
        var element = document.getElementById('edittext');
        var textvalue = element.value;
        element.value = "";
        element.style.display = "none";
        if (textvalue != '') {
            console.log(window.selectedtextx);
            console.log(window.selectedtexty);
            var textToElement = d3.select("#"+selectedtextid);
            var replacedTextId = selectedtextid.replace(/\d+/g, '');
            if(replacedTextId !== 'task') {
            var textGroup = textToElement                
                .append('g')
                .attr('transform', 'translate(' + window.selectedtextx + ',' + window.selectedtexty + ')')
                .attr('id', window.selectedtextid + '_label')
                .call(drag);
            }
                for (var i = 0; i < bpmnjson.length; i++) {
                    var eventelement = bpmnjson[i]
                    if (eventelement.id === selectedtextid) {
                        console.log(bpmnjson[i]);
                        bpmnjson[i].name = textvalue;
                    }
                }
                // var result = bpmnjson.filter(obj => {
                //     return obj.id === selectedtextid
                //   })
                // console.log(result);
            textGroup.append('text').text(textvalue);
        }
    }

}

// function setEventName(selectedtextid, selectedtextx, selectedtexty) {
//     if (selectedtextid != null) {
//         console.log(selectedtextid);
//         var element = document.getElementById('edittext');
//         var textvalue = element.value;
//         element.value = "";
//         element.style.display = "none";
//         if (textvalue != '') {
//             console.log(selectedtextx);
//             console.log(selectedtexty);
//             var textToElement = d3.select("#"+selectedtextid);
//             var textGroup = textToElement                
//                 .append('g')
//                 .attr('transform', 'translate(' + selectedtextx + ',' + selectedtexty + ')')
//                 .attr('id', selectedtextid + '_label')
//                 //.call(drag);

//             textGroup.append('text').text(textvalue);
//         }
//     }
// }

function deleteElement(id) {
    // console.log("ididid : "+id)
    console.log(id);

    for (var i = 0; i < bpmnjson.length; i++) {
        var bpmnobject = bpmnjson[i];
        // console.log(bpmnobject.id);
        if (bpmnobject.id === id) {
            bpmnobject.id = 0;
        } else if (bpmnobject.start_id === id || bpmnobject.end_id === id) {
            var flow_id = bpmnobject.id;
            //  d3.select(document.getElementById(flow_id)).remove(); 
            sampleSVG.select("#group" + flow_id).remove();
            // bpmnjson.splice(i, 1);
            bpmnobject.id = 0;
            //  delete bpmnjson[i];
        }
    }
    d3.select(document.getElementById(id)).remove();
    tooltipDiv.transition()
        .style("opacity", 0);
    // console.log(bpmnjson);

}

function dragMove(me) {
    // console.log('mouse draging');
    d3.select(".setting-box").style("opacity", 0);
    //tooltipDiv.transition().style("opacity", 0);
    // console.log(d3.select(me).attr("id"))
    var x = d3.event.x
    var y = d3.event.y

    d3.select(me).attr('transform', 'translate(' + x + ',' + y + ')')
    for (var i = 0; i < bpmnjson.length; i++) {
        if (bpmnjson[i].id == d3.select(me).attr("id")) {
            bpmnjson[i].x = x;
            bpmnjson[i].y = y;
            break;
        }
    }
}


function getScreenCoords(x, y, ctm) {
    var xn = ctm.e + x * ctm.a + y * ctm.c;
    var yn = ctm.f + x * ctm.b + y * ctm.d;
    return { x: xn, y: yn };
}

var drag = d3.behavior.drag()
    .on('drag', function (d) {
        // console.log("--dvalue--"+ d )
        // console.log("--dvalues--"+this)
        dragMove(this)
    })
    .on("dragstart", function () {
        console.log('DRAG START');
        var elementid = d3.select(this).attr("id");
         console.log(elementid);
         console.log(bpmnjson);
        for (var i = 0; i < bpmnjson.length; i++) {
            var bpmnobject = bpmnjson[i];

            // console.log(bpmnobject.start_id +'==>>>'+ bpmnobject.end_id +'==>>>>'+ elementid +'===>>>>'+ bpmnobject.id );

            if (bpmnobject.start_id === elementid && bpmnobject.id != 0) {
                console.log("Gone in first condition");
                dragFlows.push({
                    "id": bpmnobject.id,
                    "start_id": bpmnobject.start_id,
                    "end_id": bpmnobject.end_id,
                    "start_x": bpmnobject.start_x,
                    "start_y": bpmnobject.start_y,
                    "end_x": bpmnobject.end_x,
                    "end_y": bpmnobject.end_y,
                    "mid_x": bpmnobject.mid_x,
                    "start_type": bpmnobject.start_type,
                    "end_type": bpmnobject.end_type,
                    "connection": "start"
                });

                sampleSVG.select("#group" + bpmnobject.id).remove();
                var traingleId = bpmnobject.id.slice(-1);
                sampleSVG.select("#triangle" + traingleId).remove();

                bpmnobject.id = 0;
                console.log("---slipse---")
                console.log(bpmnjson)

            } else if (bpmnobject.end_id === elementid && bpmnobject.id != 0) {
                console.log("Gone in second condition");
                dragFlows.push({
                    "id": bpmnobject.id,
                    "start_id": bpmnobject.start_id,
                    "end_id": bpmnobject.end_id,
                    "start_x": bpmnobject.start_x,
                    "start_y": bpmnobject.start_y,
                    "end_x": bpmnobject.end_x,
                    "end_y": bpmnobject.end_y,
                    "mid_x": bpmnobject.mid_x,
                    "start_type": bpmnobject.start_type,
                    "end_type": bpmnobject.end_type,
                    "connection": "end"
                })
                // console.log(bpmnobject.id+" removed")
                // console.log(dragFlows)
                sampleSVG.select("#group" + bpmnobject.id).remove();
                var traingleId = bpmnobject.id.slice(-1);
                sampleSVG.select("#triangle" + traingleId).remove();

                bpmnobject.id = 0;
                // bpmnjson.splice(i, 1);
                console.log("---slipse---")
                console.log(bpmnjson)
            }
        }
    })
    .on("dragend", function () {
        console.log('DRAG END : Length of dragFlow : ' + dragFlows.length);
        for (var i = 0; i < dragFlows.length; i++) {
            var flow = dragFlows[i];

            console.log('TEST CONN : ' + flow.connection);
            console.log(flow);
            if (flow.connection === "start") {
                var circle = document.getElementById(flow.start_id),
                    cx = +circle.getAttribute('cx'),
                    cy = +circle.getAttribute('cy'),
                    ctm = circle.getCTM(),
                    coords = getScreenCoords(cx, cy, ctm);
                console.log(coords);
                if (flow.start_x < flow.end_x) {
                    if (flow.end_type === "endEvent") {
                        flow.end_x = flow.end_x + 26;
                        if (coords.x < flow.end_x) {
                            flow.end_x = flow.end_x - 26;
                            // if( (flow.end_x - coords.x) < 100 ){
                            // }
                        } else if (coords.x > flow.end_x) {
                            flow.end_x = flow.end_x + 26;
                        }

                    } else if (flow.end_type === "task") {
                        flow.end_x = flow.end_x + 67;
                        if (coords.x < flow.end_x) {
                            flow.end_x = flow.end_x - 67;
                        } else if (coords.x > flow.end_x) {
                            flow.end_x = flow.end_x + 67;
                        }
                    } else if (flow.end_type === "gateway") {
                        flow.end_x = flow.end_x + 35;
                        if (coords.x < flow.end_x) {
                            flow.end_x = flow.end_x - 35;
                        } else if (coords.x > flow.end_x) {
                            flow.end_x = flow.end_x + 35;
                        }
                    }
                } else if (flow.start_x > flow.end_x) {
                    if (flow.end_type === "endEvent") {
                        flow.end_x = flow.end_x - 26;
                        if (coords.x < flow.end_x) {
                            flow.end_x = flow.end_x - 26;
                        } else if (coords.x > flow.end_x) {
                            flow.end_x = flow.end_x + 26;
                        }
                    } else if (flow.end_type === "task") {
                        flow.end_x = flow.end_x - 67;
                        if (coords.x < flow.end_x) {
                            flow.end_x = flow.end_x - 67;
                        } else if (coords.x > flow.end_x) {
                            flow.end_x = flow.end_x + 67;
                        }
                    } else if (flow.end_type === "gateway") {
                        flow.end_x = flow.end_x - 35;
                        if (coords.x < flow.end_x) {
                            flow.end_x = flow.end_x - 35;
                        } else if (coords.x > flow.end_x) {
                            flow.end_x = flow.end_x + 35;
                        }
                    }
                }

                if (coords.x < flow.end_x) {
                    if (flow.start_type === "startEvent") {
                        startx = coords.x + 20;
                        starty = coords.y;

                        if ((flow.end_x - coords.x) < 80) {
                            startx = coords.x + 1;
                            starty = coords.y - 22;
                        }
                    } else if (flow.start_type === "task") {
                        startx = coords.x + 120;
                        starty = coords.y + 40;
                    } else if (flow.start_type === "gateway") {
                        startx = coords.x + 30;
                        starty = coords.y + 30;
                    }
                } else if (coords.x > flow.end_x) {
                    if (flow.start_type === "startEvent") {
                        startx = coords.x - 20;
                        starty = coords.y;
                    } else if (flow.start_type === "task") {
                        startx = coords.x - 2;
                        starty = coords.y + 40;
                    } else if (flow.start_type === "gateway") {
                        startx = coords.x - 30;
                        starty = coords.y + 30;
                    }
                }


                if ((flow.end_x - coords.x) < 80) {
                    midx = startx;
                } else {
                    midx = startx + ((flow.end_x - startx) / 2);
                }

                starttype = flow.start_type;
                endtype = flow.end_type;
                endx = flow.end_x;
                endy = flow.end_y;
                startid = flow.start_id;
                endid = flow.end_id;

                coordsX = coords.x
                coordsY = coords.y;

                // console.log( startx+ ' => '+ starty + ' => '+ midx + ' => '+ endx + ' => '+ endy);

                flowcreator(null);


            } else if (flow.connection === "end") {

                var circle = document.getElementById(flow.end_id),
                    cx = +circle.getAttribute('cx'),
                    cy = +circle.getAttribute('cy'),
                    ctm = circle.getCTM(),
                    coords = getScreenCoords(cx, cy, ctm);

                console.log('Flow Start - ' + flow.start_x + ' : CoordsX  - ' + coords.x + ' : Flow End - ' + flow.end_x);
                if (flow.start_x > flow.end_x) {

                    if (flow.start_type === "startEvent") {
                        flow.start_x = flow.start_x + 21;

                        if (coords.x <= flow.start_x) {
                            flow.start_x = flow.start_x - 21;
                        } else if (coords.x > flow.start_x) {
                            flow.start_x = flow.start_x + 21;
                        }
                    } else if (flow.start_type === "task") {
                        flow.start_x = flow.start_x + 67;
                        if (coords.x < flow.start_x) {
                            flow.start_x = flow.start_x - 67;
                        } else if (coords.x > flow.start_x) {
                            flow.start_x = flow.start_x + 67;
                        }
                    } else if (flow.start_type === "gateway") {
                        flow.start_x = flow.start_x + 35;
                        if (coords.x < flow.start_x) {
                            flow.start_x = flow.start_x - 35;
                        } else if (coords.x > flow.start_x) {
                            flow.start_x = flow.start_x + 35;
                        }
                    }
                } else if (flow.start_x < flow.end_x) {
                    // console.log("in ex > sx")
                    if ((flow.start_type === "startEvent")) {
                        // to get the center cordinate
                        flow.start_x = flow.start_x - 21;
                        console.log('Minus first 21 : ' + flow.start_x);

                        if (coords.x > flow.start_x) {
                            flow.start_x = flow.start_x + 21;
                        } else if (coords.x <= flow.start_x) {
                            //flow.start_x = flow.start_x - 21;
                            flow.start_x = flow.start_x;
                        }

                        console.log('Current Flow X : ' + flow.start_x);

                    } else if (flow.start_type === "task") {
                        flow.start_x = flow.start_x - 67;
                        if (coords.x < flow.start_x) {
                            flow.start_x = flow.start_x - 67;
                        } else if (coords.x > flow.start_x) {
                            flow.start_x = flow.start_x + 67;
                        }
                    } else if (flow.start_type === "gateway") {
                        flow.start_x = flow.start_x - 35;
                        if (coords.x < flow.start_x) {
                            flow.start_x = flow.start_x - 35;
                        } else if (coords.x > flow.start_x) {
                            flow.start_x = flow.start_x + 35;
                        }
                    }
                }

                if (coords.x > flow.start_x) {
                    if (flow.end_type === "endEvent") {
                        endx = coords.x - 25;
                        endy = coords.y;
                        // console.log('TO Coord X greater : '+ coords.y +' ## '+ flow.start_y + ' ## '+  ( flow.start_y + 60  ) )

                        if (coords.y < (flow.start_y + 60)) {

                        } else {
                            if (coords.y > flow.start_y) {
                                endx = coords.x;
                                endy = coords.y - 30;
                            } else if (coords.y < flow.start_y) {
                                endx = coords.x;
                                endy = coords.y + 30;
                            }
                        }

                    } else if (flow.end_type === "task") {
                        endx = coords.x + 120;
                        endy = coords.y + 40;
                    } else if (flow.end_type === "gateway") {
                        endx = coords.x - 35;
                        endy = coords.y + 30;
                    }

                } else if (coords.x < flow.start_x) {
                    // console.log('NOT TO GO....');
                    if (flow.end_type === "endEvent") {
                        endx = coords.x + 25;
                        endy = coords.y;

                        // console.log('Coord X lower : '+ coords.y +' ## '+ flow.start_y + ' ## '+  ( flow.start_y + 60  ) )

                        if (coords.y < (flow.start_y + 60)) {

                        } else {
                            if (coords.y > flow.start_y) {
                                endx = coords.x;
                                endy = coords.y - 30;
                            } else if (coords.y < flow.start_y) {
                                endx = coords.x;
                                endy = coords.y + 30;
                            }
                        }

                    } else if (flow.end_type === "task") {
                        endx = coords.x - 2;
                        endy = coords.y + 40;
                    } else if (flow.end_type === "gateway") {
                        endx = coords.x + 35;
                        endy = coords.y + 30;
                    }
                }

                midx = flow.start_x + ((endx - flow.start_x) / 2);
                starttype = flow.start_type;
                endtype = flow.end_type;
                startx = flow.start_x;
                starty = flow.start_y;
                startid = flow.start_id;
                endid = flow.end_id;

                coordsX = coords.x
                coordsY = coords.y;

                // console.log( startx+ ' => '+ starty + ' => '+ midx + ' => '+ endx + ' => '+ endy);
                flowcreator(null);
            }
        }

        dragFlows = [];
    });
