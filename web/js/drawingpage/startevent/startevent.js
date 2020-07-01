"use strict";
var selectedId = 0;
var elementType = '';
var elementSubType = '';
var textWidth = 100,
    textHeight = 30,
    dragbarw = 20;

var starteventdevider = function(eid, subElement, svg, xvalue, yvalue) {
    var group = svg
        // .append('g').attr('class', 'djs-group')
        .append('g')
        .attr('transform', 'translate(' + xvalue + ',' + yvalue + ')')
        .attr('id', 'startEvnet' + (++idstartelement))
        .call(drag)

    // var groupSelect = svg.append('g');

    if (subElement === "startEvent") {

    } else if (subElement === "TimeStartEvent") {
        group.append('circle')
            .attr("fill", "#ffffff")
            .attr("stroke", "#808080")
            .attr("r", "9")
            .attr("stroke-width", "1.5")
            .attr("stroke-linecap", "round")
            .attr("stroke-linejoin", "round")
            .attr("stroke-opacity", "1")
            .attr("transform", "matrix(1.6,0,0,1.6,0,0)")
        group.append('path')
            .attr("fill", "#ffffff")
            .attr("stroke", "#808080")
            .attr("d", "M15,5L15,8M20,6L18.5,9M24,10L21,11.5M25,15L22,15M24,20L21,18.5M20,24L18.5,21M15,25L15,22M10,24L11.5,21M6,20L9,18.5M5,15L8,15M6,10L9,11.5M10,6L11.5,9M17,8L15,15L19,15")
            .attr("stroke-width", "1.5")
            .attr("stroke-linecap", "round")
            .attr("stroke-linejoin", "round")
            .attr("stroke-opacity", "1")
            .attr("transform", "matrix(1.2,0,0,1.2,-17.9375,-17.9375)")
    } else if (subElement === "MessageStartEvent") {
        group.append('path')
            .attr("fill", "#ffffff")
            .attr("stroke", "#808080")
            .attr("d", "M7,10L7,20L23,20L23,10ZM7,10L15,16L23,10")
            .attr("stroke-width", "1.6")
            .attr("stroke-linecap", "round")
            .attr("stroke-linejoin", "round")
            .attr("stroke-opacity", "1")
            .attr("transform", "matrix(1.4375,0,0,1.4375,-20.9375,-20.9375)")
    } else if (subElement === "ErrorStartEvent") {
        group.append('path')
            .attr("fill", "#ffffff")
            .attr("stroke", "#808080")
            .attr("d", "M21.820839,10.171502L18.36734,23.58992L12.541380000000002,13.281818999999999L8.338651200000001,19.071607L12.048949000000002,5.832305699999999L17.996148000000005,15.132659L21.820839,10.171502Z")
            .attr("stroke-width", "1.6")
            .attr("stroke-linecap", "round")
            .attr("stroke-linejoin", "round")
            .attr("stroke-opacity", "1")
            .attr("transform", "matrix(1.4375,0,0,1.4375,-20.9375,-20.9375)")
    }

    group.append('circle')
        .attr('id', 'startEvnet' + idstartelement)
        .style("stroke", "black")
        .style("stroke-width", "2")
        .style("fill-opacity", "0")
        .attr('r', '20')
        .on("mouseover", function() {
            console.log('mouse moving');
            d3.select(this).style("fill", "aliceblue");
        })
        .on("mouseup", function() {
            console.log("mouse up");
            d3.select(this).style("fill", "aliceblue");
            var t = d3.select(this).attr("id");

            function getScreenCoords(x, y, ctm) {
                var xn = ctm.e + x * ctm.a + y * ctm.c;
                var yn = ctm.f + x * ctm.b + y * ctm.d;
                return { x: xn, y: yn };
            }
            var circle = document.getElementById(t),
                cx = +circle.getAttribute('cx'),
                cy = +circle.getAttribute('cy'),
                ctm = circle.getCTM(),
                coords = getScreenCoords(cx, cy, ctm);
            tooltipDiv.transition()
                .duration(200)
                .style("opacity", 1.9);
            $(".setting-box").css("display", "block");
            tooltipDiv.html("<input id=" + "trash-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/trash-icon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >" + "&nbsp" + "<input id=" + "arrow-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/arrow.png" + " alt=" + "arrow" + " style=" + "width:25px;" + " >" + "<br>" + "<input id=" + "property-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/settingsicon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >" + "<input id=" + "text-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/review.png" + " alt=" + "Text" + " style=" + "width:25px;" + " >")
                .style("left", coords.x + "px")
                .style("top", (coords.y) + "px");
            tooltipDiv.select("#trash-button").on("click", function() {
                deleteElement(t);
                $(".setting-box").css("display", "none");
                console.log("t click")
            });

            tooltipDiv.select("#property-button").on("click", function() {
                tooltipDiv.style("opacity", 0);
                $(".setting-box").css("display", "none");
                for (var i = 0; i < bpmnjson.length; i++) {
                    var element = bpmnjson[i]
                    if (element.id === t) {
                        console.log(bpmnjson[i]);
                        selectedId = t;
                        elementType = "StartEvent";
                        elementSubType = element.subtype;
                        if (element.subtype === "StartEvent") {
                            selectedId = "SE" + t;
                            showFunction(selectedId, element.subtype);
                        } else if (element.subtype === "TimeStartEvent") {
                            showFunction(t, element.subtype);
                            selectedId = "TSE" + t;
                        } else if (element.subtype === "MessageStartEvent") {
                            selectedId = "MSE" + t;
                            showFunction(selectedId, element.subtype);
                        } else if (element.subtype === "ErrorStartEvent") {
                            showFunction(t, element.subtype);
                            selectedId = "ESE" + t;
                        }
                    }
                }
            });

            tooltipDiv.select("#text-button").on("click", function() {
                tooltipDiv.style("opacity", 0);
                $(".setting-box").css("display", "none");
                //d3.select(document.getElementById('startEvnet' + idstartelement + '_label')).remove();

                //console.log("txt button clicked "+ width +' ==>>>'+ height);
                var element = document.getElementById('edittext');
                //console.log(element);
                var strTop = coords.y + 22;
                var strleft = coords.x - 30;
                element.style.width = textWidth + "px";
                element.style.height = textHeight + "px";
                element.style.left = strleft + "px";
                element.style.top = strTop + "px";
                element.style.display = "block";
                //console.log('set data' + strTop + ' == ' + strleft);
                window.selectedtextid = t;
                window.selectedtextx = Math.round(-23);
                window.selectedtexty = Math.round(30);
                //setEventName(selectedtextid, selectedtextx, selectedtexty);               
            });


            // var CircleWidth = this.getBoundingClientRect().width;
            // var CircleHeight = this.getBoundingClientRect().height;
            tooltipDiv.select("#arrow-button").on("click", function() {
                console.log('circle arrow 1');
                tooltipDiv.style("opacity", 0);
                $(".setting-box").css("display", "none");
                // console.log("end arrow button clicked ")
                starttype = "startEvent";
                startid = t;
                startx = coords.x + 20;
                starty = coords.y;
                coordsX = coords.x
                coordsY = coords.y;
                window.bpmnElement = "flowselect";
                document.body.style.cursor = "e-resize";

                // var rad = 5;
                // var x = d3.mouse(d3.select('#a').node())[0],
                //     y = d3.mouse(d3.select('#a').node())[1];
                // d3.select('#dummyPath').attr('x2', x - rad).attr('y2', y - rad);
                // d3.select('#dummyPath').style("display", "block");


                // flowcreator(null);
            });

        })
        .on("mouseout", function() {
            console.log('mouse out');
            d3.select(this).style("fill", "white");
            tooltipDiv.transition()
                .duration(3200)
                .style("opacity", 0)

            setTimeout(function() {
                $('.setting-box').hide(); // or fade, css display however you'd like.
            }, 5000);
        })
        .on("click", function() {
            d3.select(this).style("fill", "white");
            var t = d3.select(this).attr("id");

            function getScreenCoords(x, y, ctm) {
                var xn = ctm.e + x * ctm.a + y * ctm.c;
                var yn = ctm.f + x * ctm.b + y * ctm.d;
                return { x: xn, y: yn };
            }
            var circle = document.getElementById(t),
                cx = +circle.getAttribute('cx'),
                cy = +circle.getAttribute('cy'),
                ctm = circle.getCTM(),
                coords = getScreenCoords(cx, cy, ctm);
            // coordsX = coords.x
            // coordsY = coords.y;
            if (window.bpmnElement === "flowselect") {
                endtype = "endEvent";
                endid = t;
                // endx = coords.x - 30;
                // endx = coords.x - 20;
                endx = coords.x;
                endy = coords.y;
                midx = startx + ((endx - startx) / 2);
            }
        })
    if (eid === null) {
        eid = 'startEvnet' + idstartelement;
    }
    EventBPMNJsonCreator(eid, xvalue, yvalue, 20, 20, "startEvnet", subElement);
    subElement = null;
}