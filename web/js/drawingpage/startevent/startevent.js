"use strict";
var selectedId=0;
var elementType='';
var elementSubType='';
var width = 120, height = 80, dragbarw = 20;
var starteventdevider = function (eid,subElement,svg,xvalue,yvalue){    
    var group = svg.append('g')
        .attr('transform', 'translate(' + xvalue + ',' + yvalue + ')')
        .attr('id', 'startEvnet' + (++idstartelement))
        .call(drag)
    var groupSelect = svg.append('g')
         if (subElement === "startEvent") {
            
        } else if (subElement === "TimeStartEvent") {
                group.append('circle')
                    .attr("fill","#ffffff")
                    .attr("stroke","#808080")
                    .attr("r","9")   
                    .attr("stroke-width","1.5")
                    .attr("stroke-linecap","round")
                    .attr("stroke-linejoin","round")
                    .attr("stroke-opacity","1")
                    .attr("transform","matrix(1.6,0,0,1.6,0,0)")
                group.append('path')
                    .attr("fill","#ffffff")
                    .attr("stroke","#808080")
                    .attr("d","M15,5L15,8M20,6L18.5,9M24,10L21,11.5M25,15L22,15M24,20L21,18.5M20,24L18.5,21M15,25L15,22M10,24L11.5,21M6,20L9,18.5M5,15L8,15M6,10L9,11.5M10,6L11.5,9M17,8L15,15L19,15")   
                    .attr("stroke-width","1.5")
                    .attr("stroke-linecap","round")
                    .attr("stroke-linejoin","round")
                    .attr("stroke-opacity","1")
                    .attr("transform","matrix(1.2,0,0,1.2,-17.9375,-17.9375)")
        } else if (subElement === "MessageStartEvent") {
                group.append('path')
                    .attr("fill","#ffffff")
                    .attr("stroke","#808080")
                    .attr("d","M7,10L7,20L23,20L23,10ZM7,10L15,16L23,10")   
                    .attr("stroke-width","1.6")
                    .attr("stroke-linecap","round")
                    .attr("stroke-linejoin","round")
                    .attr("stroke-opacity","1")
                    .attr("transform","matrix(1.4375,0,0,1.4375,-20.9375,-20.9375)")
        } else if (subElement === "ErrorStartEvent") {
                group.append('path')
                    .attr("fill","#ffffff")
                    .attr("stroke","#808080")
                    .attr("d","M21.820839,10.171502L18.36734,23.58992L12.541380000000002,13.281818999999999L8.338651200000001,19.071607L12.048949000000002,5.832305699999999L17.996148000000005,15.132659L21.820839,10.171502Z")   
                    .attr("stroke-width","1.6")
                    .attr("stroke-linecap","round")
                    .attr("stroke-linejoin","round")
                    .attr("stroke-opacity","1")
                    .attr("transform","matrix(1.4375,0,0,1.4375,-20.9375,-20.9375)")
        }

            group.append('foreignObject')
                .attr('id', 'fobject' + idstartelement)
                .attr("x", function(d) { return 0 ; })
                .attr("y", function(d) { return 0; })
                .attr('width', width - 60)
                .attr('height', height - 40)
                .html("<div id=\"textidstartEvnet"+idstartelement+"\"; style=\"width: 80%; height:45px ; background-color: transparent;\" >Start Event</div>");
      

            group.append('circle')
                .attr('id', 'startEvnet' + idstartelement)
                .style("stroke", "black")
                .style("stroke-width", "2")
                .style("fill-opacity", "0")
                .attr('r', '20')
                .on("mouseover", function () {
                    console.log('mouse moving');
                    d3.select(this).style("fill", "aliceblue");
                })
                .on("mouseup", function () {
                    d3.select(this).style("fill", "aliceblue");
                    var t = d3.select(this).attr("id");
                    function getScreenCoords(x, y, ctm) {
                        var xn = ctm.e + x * ctm.a + y * ctm.c;
                        var yn = ctm.f + x * ctm.b + y * ctm.d;
                        return {x: xn, y: yn};
                    }
                    var circle = document.getElementById(t),
                    cx = +circle.getAttribute('cx'),
                    cy = +circle.getAttribute('cy'),
                    ctm = circle.getCTM(),
                    coords = getScreenCoords(cx, cy, ctm);
                    tooltipDiv.transition()
                        .duration(200)
                    .style("opacity", 1.9);
                    tooltipDiv.html("<input id=" + "trash-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/trash-icon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >"+"&nbsp"+"<input id=" + "arrow-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/arrow.png" + " alt=" + "arrow" + " style=" + "width:25px;" + " >" + "<br>" + "<input id=" + "property-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/settingsicon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >"+"<input id=" + "text-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/review.png" + " alt=" + "Text" + " style=" + "width:25px;" + " >")
                        .style("left", coords.x + 30 + "px")
                        .style("top", (coords.y - 30) + "px");
                    tooltipDiv.select("#trash-button").on("click", function () {
                    deleteElement(t);
                    console.log("t click")
                });
                tooltipDiv.select("#property-button").on("click", function () {
                    tooltipDiv.style("opacity", 0);
                    for (var i = 0; i < bpmnjson.length ; i++) {
                        var element = bpmnjson[i]
                        if (element.id === t) {
                        	selectedId=t;
                            elementType="StartEvent";
                            elementSubType=element.subtype;
                            if (element.subtype === "StartEvent") {
                            	selectedId="SE"+t;
                            	showFunction(selectedId,element.subtype);                                
                            }else if (element.subtype === "TimeStartEvent") {
                            	showFunction(t,element.subtype);
                            	selectedId="TSE"+t;
                            }else if (element.subtype === "MessageStartEvent") {
                                selectedId="MSE"+t;
                                showFunction(selectedId,element.subtype);                            	
                            }else if (element.subtype === "ErrorStartEvent") {
                            	showFunction(t,element.subtype);
                            	selectedId="ESE"+t;
                            }
                        }
                    }
                });
                tooltipDiv.select("#text-button").on("click", function () {
                    tooltipDiv.style("opacity", 0);
                    console.log("end evnt button clicked ")
                    var element = document.getElementById('edittext');
                    element.style.width = width+"px";
                    element.style.height = height+"px";
                    element.style.display = "block";
                    element.style.left = coords.x+"px";
                    element.style.top = coords.y+"px";                    
                    element.value = document.getElementById("textid"+t).innerHTML;
                    window.selectedtextid = "textid"+t;                    
                });
                var CircleWidth = this.getBoundingClientRect().width;
                var CircleHeight = this.getBoundingClientRect().height;
                tooltipDiv.select("#arrow-button").on("click", function () {
                    console.log('circle arrow 1');
                    tooltipDiv.style("opacity", 0);
                    console.log("end arrow button clicked ")
                    starttype = "startEvent";
                    startid =t;
                    startx = coords.x;
                    starty = coords.y;
                    coordsX = coords.x
                    coordsY = coords.y;
                    window.bpmnElement = "flowselect";
                    document.body.style.cursor = "e-resize";
                });

            })
            .on("mouseout", function () {
                console.log('mouse out');
                d3.select(this).style("fill", "white");
                tooltipDiv.transition()
                    .duration(3200)
                    .style("opacity", 0);

            })
            .on("click", function () {
                d3.select(this).style("fill", "white");
                var t = d3.select(this).attr("id");
                function getScreenCoords(x, y, ctm) {
                    var xn = ctm.e + x * ctm.a + y * ctm.c;
                    var yn = ctm.f + x * ctm.b + y * ctm.d;
                    return {x: xn, y: yn};
                }
                var circle = document.getElementById(t),
                    cx = +circle.getAttribute('cx'),
                    cy = +circle.getAttribute('cy'),
                    ctm = circle.getCTM(),
                    coords = getScreenCoords(cx, cy, ctm);
                    coordsX = coords.x
                    coordsY = coords.y;
                if (window.bpmnElement === "flowselect") {
                    endtype = "endEvent";
                    endid = t;
                    endx = coords.x -30;
                    endy = coords.y;
                    midx = startx + ((endx - startx) / 2);
                }
            })
            if (eid === null) {
                eid ='startEvnet'+idstartelement;
            }
            EventBPMNJsonCreator(eid, xvalue, yvalue, 20, 20,"startEvnet",subElement);
            subElement = null;
 }