"use strict";

//var dragFlows =[];

var g2;
var points = [], g;

var bpmnEventDivider = function (bpmnElement, subElement, svg) {
    // console.log(bpmnElement);
    // d3.event.pageX & d3.event.pageY
    if (bpmnElement === "startEvent") {
        window.bpmnElement = null;
        starteventdevider(null, subElement, svg, d3.event.offsetX, d3.event.offsetY);
    } else if (bpmnElement === "endEvent") {
        window.bpmnElement = null;
        endeventdevider(null, subElement, svg, d3.event.offsetX, d3.event.offsetY);
    } else if (bpmnElement === "task") {
        window.bpmnElement = null;
        // var sampleSVG = svg;
        taskdevider(null, subElement, svg, d3.event.offsetX, d3.event.offsetY);
    } else if (bpmnElement === "gateway") {
        window.bpmnElement = null;
        gatewaydevider(null, subElement, svg, d3.event.offsetX, d3.event.offsetY);
    } else if (bpmnElement === "datastore") {
        window.bpmnElement = null;
        datastoredevider(null, subElement, svg, d3.event.offsetX, d3.event.offsetY);
    } else if (bpmnElement === "subprocess") {
        window.bpmnElement = null;
        subprocessdevider(null, subElement, svg, d3.event.offsetX, d3.event.offsetY);
    } else if (bpmnElement === "flow" || bpmnElement === "flowselect") {
        window.bpmnElement = null;
        flowcreator(null, subElement, svg, d3.event.offsetX, d3.event.offsetY);
    }

    if (window.selectedtextid != null) {
        var element = document.getElementById('edittext');
        var textvalue = element.value;
        textvalue.trim();
        element.value = "";
        element.style.display = "none";
        if (textvalue != '') {
            var textToElement = d3.select("#" + selectedtextid);
            var replacedTextId = selectedtextid.replace(/\d+/g, '');
            if (replacedTextId !== 'task' && replacedTextId !== 'flow') {
                var textGroup = textToElement
                    .append('g')
                    .attr('transform', 'translate(' + window.selectedtextx + ',' + window.selectedtexty + ')')
                    .attr('id', window.selectedtextid + '_label')
                    .call(drag);
            }
            if (replacedTextId == 'flow') {
                var flowElementSelector = $("#" + selectedtextid).parents("g").attr('id');
                var flowElementSelectordiv = d3.select("#" + flowElementSelector);
                var flowElementselectivex = Number($("#" + selectedtextid).attr('x')) + Number(50);
                var flowElementselectivey = Number($("#" + selectedtextid).attr('y')) + Number(50);
                var textGroup = flowElementSelectordiv
                    .insert('g')
                    .attr('transform', 'translate(' + flowElementselectivex + ',' + flowElementselectivey + ')')
                    .attr('id', window.selectedtextid + '_label')
                    .call(drag);
            }
            for (var i = 0; i < bpmnjson.length; i++) {
                var eventelement = bpmnjson[i]
                if (eventelement.id === selectedtextid) {
                    // console.log(bpmnjson[i]);
                    bpmnjson[i].name = textvalue.trim();
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

function deleteElement(id) {
    // console.log("ididid : "+id)
    // console.log(id);

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
    console.log('mouse draging');
    d3.select(".setting-box").style("opacity", 0);
    var x = d3.event.x;
    var y = d3.event.y;

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

function getCircleCoordById(strId) {
    var circle = document.getElementById(strId),
        cx = +circle.getAttribute('cx'),
        cy = +circle.getAttribute('cy'),
        ctm = circle.getCTM();
    return getScreenCoords(cx, cy, ctm);
}

// d3.select('svg').on('mousemove', function() {
//     if (dragging) {
//         var rad = 5;
//         var x = d3.mouse(d3.select('#a').node())[0],
//             y = d3.mouse(d3.select('#a').node())[1];
//         d3.select('#dummyPath').attr('x2', x - rad).attr('y2', y - rad);
//         d3.select('#dummyPath').style("display", "block")
//     }
// });

var drag = d3.behavior.drag()
    .on('drag', function (d) {
        dragMove(this)
    })
    .on("dragstart", function () {
        console.log('DRAG START');
        var elementid = d3.select(this).attr("id");
        for (var i = 0; i < bpmnjson.length; i++) {
            var bpmnobject = bpmnjson[i];
            console.log('dragFlows Check : ' + bpmnobject.start_id + '==>>>' + bpmnobject.end_id + '==>>>>' + elementid + '===>>>>' + bpmnobject.id);
            if (bpmnobject.start_id === elementid && bpmnobject.id != 0) {
                console.log("Drag Flow Gone in first condition");
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
                // console.log("---slipse---")
                // console.log(bpmnjson)

            } else if (bpmnobject.end_id === elementid && bpmnobject.id != 0) {
                console.log("Drag Flow Gone in second condition");
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
                // console.log("---slipse---")
                // console.log(bpmnjson)
            }
        }
    })
    .on("dragend", function () {
        console.log('DRAG END : Length of dragFlow : ' + dragFlows.length);
        /* drag limit */
            // startevent 154x 190y  164 242 l   399 304 c   154 187 of
            //process      95x 144y  300 266 l   535  328 c

        console.log(d3.event);
        var x = d3.event.sourceEvent.clientX;
        var y = d3.event.sourceEvent.clientY;
        var dropperElement = d3.select(document.elementFromPoint(x, y)).attr("id");
        var droppingElement = d3.select(this);
        console.log(droppingElement);
        console.log(dropperElement);
        if(dropperElement !== null && dropperElement.search('subprocess') !== '') {
            console.log(inter);
            if(inter){
                console.log(inter)
                d3.select(this).attr("transform", "translate(" + x + "," + y + ")");                
                droppingElement.appendTo(dropperElement);
            } 
            // else {
            //     drag.on("drag", null);
            // }
        }
    /* drag limit */
        for (var i = 0; i < dragFlows.length; i++) {
            var flow = dragFlows[i];

            console.log('TEST CONN : ' + flow.connection);
            // console.log(flow);
            if (flow.connection === "start") {
                var coords = getCircleCoordById(flow.start_id);

                // console.log('PRINCE PANDEY');
                if (flow.start_x < flow.end_x) {
                    if (flow.end_type === "endEvent") {
                        flow.end_x = flow.end_x + 26;
                        if (coords.x < flow.end_x) {
                            flow.end_x = flow.end_x - 26;
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
                var coords = getCircleCoordById(flow.end_id);
                var parentCircleCoords = getCircleCoordById(flow.start_id);
                console.log(flow.start_id + ' =>> ' + parentCircleCoords.x + ' ==  ' + parentCircleCoords.y);
                // console.log(flow.end_id +' =>> '+coords.x +' == '+ coords.y);
                console.log('Flow StartX - ' + flow.start_x + ' CoordsX : ' + coords.x + ' CoordsY : ' + coords.y + ' : Flow EndX - ' + flow.end_x);

                if ((parentCircleCoords.x - 20) > flow.end_x) {
                    // console.log('StartX is Greater go.');

                    if (flow.start_type === "startEvent") {
                        if (coords.x > (parentCircleCoords.x + 20)) {
                            flow.start_x = parentCircleCoords.x + 20;
                        } else {
                            if ((coords.x > (parentCircleCoords.x - 20))) {
                                flow.start_x = parentCircleCoords.x;
                                // flow.start_y = parentCircleCoords.y + 20;
                                if (parentCircleCoords.y > coords.y) {
                                    flow.start_y = parentCircleCoords.y - 20;
                                } else {
                                    flow.start_y = parentCircleCoords.y + 20;
                                }
                            } else {
                                flow.start_x = parentCircleCoords.x - 20;
                                flow.start_y = parentCircleCoords.y;
                            }
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
                } else if (((parentCircleCoords.x + 20) >= flow.end_x) && ((parentCircleCoords.x - 20) <= flow.end_x)) {
                    // console.log('Gone in between Case.');
                    flow.start_x = parentCircleCoords.x;

                    if (coords.y < parentCircleCoords.y) {
                        flow.start_y = parentCircleCoords.y - 20;
                    } else {
                        flow.start_y = parentCircleCoords.y + 20;
                    }

                } else if ((parentCircleCoords.x + 20) < flow.end_x) {
                    // SX : 200 , EX : 400
                    // console.log('EndX is Greater go.');
                    if ((flow.start_type === "startEvent")) {

                        if (coords.x < (parentCircleCoords.x - 20)) {
                            flow.start_x = parentCircleCoords.x - 20;
                        } else {
                            if ((coords.x < (parentCircleCoords.x + 20))) {
                                flow.start_x = parentCircleCoords.x;
                                if (parentCircleCoords.y < coords.y) {
                                    flow.start_y = parentCircleCoords.y + 20;
                                } else {
                                    flow.start_y = parentCircleCoords.y - 20;
                                }
                            } else {
                                flow.start_x = parentCircleCoords.x + 20;
                                flow.start_y = parentCircleCoords.y;
                            }
                        }

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

                //if ((parentCircleCoords.x - 20) > flow.end_x) {
                if (coords.x > (parentCircleCoords.x + 20)) {
                    console.log('CoordX is greater');
                    if (flow.end_type === "endEvent") {

                        endx = coords.x - 25;
                        endy = coords.y;
                        if (coords.y < (parentCircleCoords.y - 20)) {
                            // console.log('Prince');
                        } else {
                            // console.log('Pandey');
                            if (( (coords.y - 20 ) > (parentCircleCoords.y - 20)) && ( (coords.y + 20 ) < (parentCircleCoords.y + 20))) {
                                endx = coords.x - 30;
                                endy = coords.y;
                            } else if (coords.y > (parentCircleCoords.y + 20)) {
                                endx = coords.x;
                                endy = coords.y - 25;
                            } else if (coords.y < (parentCircleCoords.y - 20)) {
                                endx = coords.x;
                                endy = coords.y + 20;
                            }
                        }
                    } else if (flow.end_type === "task") {
                        endx = coords.x + 120;
                        endy = coords.y + 40;
                    } else if (flow.end_type === "gateway") {
                        endx = coords.x - 35;
                        endy = coords.y + 30;
                    }
                } else if ((coords.x <= (parentCircleCoords.x + 20)) && (coords.x >= (parentCircleCoords.x - 20))) {
                    console.log('Gone in between Case.');
                    endx = coords.x;
                    if (coords.y < parentCircleCoords.y) {
                        endy = coords.y + 25;
                    } else {
                        endy = coords.y - 25;
                    }

                } else if (coords.x < (parentCircleCoords.x - 20)) {
                    console.log('CoordX is lesser');
                    if (flow.end_type === "endEvent") {
                        endx = coords.x + 25;
                        endy = coords.y;
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
