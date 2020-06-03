"use strict";
var width = 120, height = 80, dragbarw = 20;
var endeventdevider = function (eid, subElement, svg, xvalue, yvalue) {
    var group = svg.append('g')
        .attr('transform', 'translate(' + xvalue + ',' + yvalue + ')')
        .attr('id', 'endEvent' + (++idendelement))
        .call(drag)

    if (subElement === "EndEvent") {

    } else if (subElement === "ErrorEndEvent") {
        console.log("error inside")
        group.append('path')
            .attr("fill", "#808080")
            .attr("stroke", "none")
            .attr("d", "M21.820839,10.171502L18.36734,23.58992L12.541380000000002,13.281818999999999L8.338651200000001,19.071607L12.048949000000002,5.832305699999999L17.996148000000005,15.132659L21.820839,10.171502Z")
            .attr("stroke-width", "1.6")
            .attr("stroke-linecap", "round")
            .attr("stroke-linejoin", "round")
            .attr("stroke-opacity", "1")
            .attr("transform", "matrix(1.2375,0,0,1.2375,-18.9375,-18.9375)")
    } else if (subElement === "CancelEndEvent") {
        group.append('path')
            .attr("fill", "#808080")
            .attr("stroke", "none")
            .attr("d", "M6.283910500000001,9.27369L9.151395,6.4062062L14.886362000000002,12.141174L20.621331,6.4062056L23.488814,9.273689L17.753846,15.008657L23.488815,20.743626L20.621331,23.611111L14.886362000000002,17.876142L9.151394,23.611109L6.283911000000001,20.743625L12.018878,15.008658L6.283910500000001,9.27369Z")
            .attr("stroke-width", "1.5")
            .attr("stroke-linecap", "round")
            .attr("stroke-linejoin", "round")
            .attr("stroke-opacity", "1")
            .attr("transform", "matrix(1.2375,0,0,1.2375,-18.9375,-18.9375)")
    } else if (subElement === "TerminateEndEvent") {
        group.append('circle')
            .attr("fill", "#808080")
            .attr("stroke", "#808080")
            .attr("r", "10.5")
            .attr("stroke-width", "1.6")
            .attr("stroke-linecap", "round")
            .attr("stroke-linejoin", "round")
            .attr("stroke-opacity", "1")
            .attr("transform", "matrix(1.4375,0,0,1.4375,0,0)")
    }

    // group.append('foreignObject')
    //         .attr('id', 'fobject' + idendelement)
    //         .attr("x", function(d) { return 0 ; })
    //         .attr("y", function(d) { return 0; })
    //         .attr('width', width - 60)
    //         .attr('height', height - 40)
    //         .html("<div id=\"textidendEvent"+idendelement+"\"; style=\"width: 80%; height:45px ; background-color: transparent;\" >End Event</div>");

    group.append('circle')
        .attr('id', 'endEvent' + idendelement)
        .style("stroke", "black")
        .style("stroke-width", "4")
        .style("fill-opacity", "0")
        .attr('r', '20')
        .on("dragend", function () {
            console.log("drag start event")
        })
        .on("mouseover", function () {
            d3.select(this).style("fill", "aliceblue");
        })
        .on("mouseup", function () {
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
            console.log(coords.x, coords.y);
            tooltipDiv.transition()
                .duration(200)
                .style("opacity", 1.9);
            tooltipDiv.html("<input id=" + "trash-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/trash-icon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >" + "&nbsp" + "<br>" + "<input id=" + "property-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/settingsicon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >" + "<input id=" + "text-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/review.png" + " alt=" + "Text" + " style=" + "width:25px;" + " >")
                .style("left", coords.x + 35 + "px")
                .style("top", (coords.y - 30) + "px");
            tooltipDiv.select("#trash-button").on("click", function () {
                deleteElement(t);
                t = 0;
            });
            tooltipDiv.select("#property-button").on("click", function () {
                // Added Code for Getting Selected Id and Sub Type                    
                for (var i = 0; i < bpmnjson.length; i++) {
                    var element = bpmnjson[i]
                    if (element.id === t) {
                        selectedId = t;
                        elementType = "EndEvent";
                        elementSubType = element.subtype;
                        console.log("++++++++++++++")
                        console.log(element.subtype)
                        if (element.subtype === "EndEvent") {
                            selectedId = "EE" + t;
                            showFunction(selectedId, element.subtype);
                        } else if (element.subtype === "ErrorEndEvent") {
                            selectedId = "EEE" + t;
                            showFunction(selectedId, element.subtype);
                        } else if (element.subtype === "TerminateEndEvent") {
                            selectedId = "TEE" + t;
                            showFunction(selectedId, element.subtype);
                        } else if (element.subtype === "CancelEndEvent") {
                            selectedId = "CEE" + t;
                            showFunction(selectedId, element.subtype);
                        }
                    }
                }
                //End
                tooltipDiv.style("opacity", 0);
            });
            tooltipDiv.select("#text-button").on("click", function () {
                tooltipDiv.style("opacity", 0);
                console.log("end evnt button clicked ")
                var element = document.getElementById('edittext');
                element.style.width = width + "px";
                element.style.height = height + "px";
                element.style.display = "block";
                element.style.left = coords.x + "px";
                element.style.top = coords.y + "px";
                element.value = document.getElementById("textid" + t).innerHTML;
                window.selectedtextid = "textid" + t;
            });
        })
        .on("mouseout", function () {
            d3.select(this).style("fill", "white");
            tooltipDiv.transition()
                .duration(3200)
                .style("opacity", 0);
        })
        .on("click", function () {
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
            if (window.bpmnElement === "flowselect") {
                endtype = "endEvent";
                drawing = true;
                window.bpmnElement = null;
                console.log("iddddd : " + t);
                if (coords.x > startx) {
                    if (starttype === "startEvent") {
                        startx = startx + 20;
                        starty = starty;
                    } else if (starttype === "task") {
                        startx = startx + taskwidth;
                        starty = starty + 40;
                    } else if (starttype === "gateway") {
                        startx = startx + 30;
                        starty = starty + 30;
                    }
                    endx = coords.x - 26;
                    endy = coords.y;
                } else if (coords.x < startx) {
                    if (starttype === "startEvent") {
                        startx = startx - 20;
                        starty = starty;
                    } else if (starttype === "task") {
                        startx = startx - 2;
                        starty = starty + 40;
                    } else if (starttype === "gateway") {
                        startx = startx - 30;
                        starty = starty + 30;
                    }
                    endx = coords.x + 26;
                    endy = coords.y;
                }
                endid = t;
                midx = startx + ((endx - startx) / 2);
                console.log("startid : " + startid);
                console.log("startx : " + startx);
                console.log("starty : " + starty);
                flowcreator();
            }
        })
    if (eid === null) {
        eid = 'endEvent' + idendelement;
    }
    EventBPMNJsonCreator(eid, xvalue, yvalue, 20, 20, "endEvent", subElement);
    subElement = null;
}