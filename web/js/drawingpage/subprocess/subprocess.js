"use strict";
var textWidth = 100, textHeight = 30, dragbarw = 20;
var subprocessdevider = function (eid,subElement,svg,xvalue,yvalue){
var group = svg.append('g')
        .attr('transform', 'translate(' + xvalue + ',' + yvalue + ')')
        .attr('id', 'subprocess' + (++idsubprocess))
        .call(drag);
var g2 =    group.append("g")
            .attr('id', 'subprocess' + (++idsubprocess))
            
            g2.append('rect')
                .attr("x", 0)
                .attr("y", 0) 
                .attr("rx", 10)
                .attr("ry", 10)
                .style("fill", "white")
                .style("width", "350px")
                .style("height", "200px")
                .style("stroke", "black")  
                .style("stroke-width", "2px")
                .style("fill-opacity", 0.95)
var g3 =    g2.append('text')
                .attr("lineHeight", 1.2)
                .style("font-family", "Arial, sans-serif")
                .style("font-size", "12px")
                .style("font-weight", "normal")
                .style("fill", "black")
            g3.append('tspan')
                    .attr("x", 175)
                    .attr("y", 15.79)

            group.append('rect')
                    .attr("x", -6)
                    .attr("y", -6)
                    .style("width", "362px")
                    .style("height", "212px")
                    .style("fill", "none")
            group.append('rect')
                    .attr("x", 0)
                    .attr("y", 0)
                    .style("width", "350px")
                    .style("height", "200px")
                    .style("fill", "none")
                    .style("stroke-opacity", 0)
                    .style("stroke", "white")
                    .style("stroke-width", "15px")
            group.append('rect')
                    .attr("x", 0)
                    .attr("y", 0)
                    .style("width", "350px")
                    .style("height", "30px")
                    .style("fill", "none")
                    .style("stroke-opacity", 0)
                    .style("stroke", "white")
                    .style("stroke-width", "15px")


                .on("mouseover", function () {
                    console.log('mouse moving');
                    d3.select(this).style("fill", "aliceblue");            
                })
                .on("mouseup", function () {
                    console.log("mouse up");
                    d3.select(this).style("fill", "aliceblue");
                    var t = d3.select(this).attr("id");
                    console.log(t);
                    function getScreenCoords(x, y, ctm) {
                        var xn = ctm.e + x * ctm.a + y * ctm.c;
                        var yn = ctm.f + x * ctm.b + y * ctm.d;
                        return { x: xn, y: yn };
                    }
                    var subprocess = document.getElementById(t),
                        cx = +subprocess.getAttribute('cx'),
                        cy = +subprocess.getAttribute('cy'),
                        ctm = subprocess.getCTM(),
                        coords = getScreenCoords(cx, cy, ctm);
                    tooltipDiv.transition()
                        .duration(200)
                        .style("opacity", 1.9);
                        $(".setting-box").css("display","block");
                    tooltipDiv.html("<input id=" + "trash-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/trash-icon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >" + "&nbsp" + "<input id=" + "arrow-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/arrow.png" + " alt=" + "arrow" + " style=" + "width:25px;" + " >" + "<br>" + "<input id=" + "property-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/settingsicon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >" + "<input id=" + "text-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/review.png" + " alt=" + "Text" + " style=" + "width:25px;" + " >")
                        .style("left", coords.x + 30 + "px")
                        .style("top", (coords.y - 30) + "px");
                    tooltipDiv.select("#trash-button").on("click", function () {
                        deleteElement(t);
                        $(".setting-box").css("display","none");
                        console.log("t click")
                    });
        
                    tooltipDiv.select("#property-button").on("click", function () {
                        tooltipDiv.style("opacity", 0);  
                        $(".setting-box").css("display","none");              
                        for (var i = 0; i < bpmnjson.length; i++) {
                            var element = bpmnjson[i]
                            if (element.id === t) {
                                console.log(bpmnjson[i]);
                                selectedId = t;
                                elementType = "subprocess";
                                elementSubType = element.subtype;
                                if (element.subtype === "subprocess") {
                                    selectedId = "DS" + t;
                                    showFunction(selectedId, element.subtype);
                                }
                            }
                        }
                    });
        
                    tooltipDiv.select("#text-button").on("click", function () {
                        tooltipDiv.style("opacity", 0);
                        $(".setting-box").css("display","none");                        
                        var element = document.getElementById('edittext');                        
                        var strTop = coords.y + 22;
                        var strleft = coords.x - 30;
                        element.style.width = textWidth + "px";
                        element.style.height = textHeight + "px";
                        element.style.left = strleft + "px";
                        element.style.top = strTop + "px";
                        element.style.display = "block";                        
                        window.selectedtextid = t;
                        window.selectedtextx = Math.round(-23);
                        window.selectedtexty = Math.round(30);                 
                        //setEventName(selectedtextid, selectedtextx, selectedtexty);               
                    });
        
                    
                    tooltipDiv.select("#arrow-button").on("click", function () {
                        console.log('subprocess arrow 1');
                        tooltipDiv.style("opacity", 0);
                        $(".setting-box").css("display","none");
                        // console.log("end arrow button clicked ")
                        starttype = "subprocess";
                        startid = t;
                        startx = coords.x + 20;
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
                        .style("opacity",0)                
                       
                    setTimeout(function(){
                        $('.setting-box').hide();// or fade, css display however you'd like.
                        }, 5000);
                })
                .on("click", function () {
                    d3.select(this).style("fill", "white");
                    var t = d3.select(this).attr("id");
                    console.log(t);
                    function getScreenCoords(x, y, ctm) {
                        var xn = ctm.e + x * ctm.a + y * ctm.c;
                        var yn = ctm.f + x * ctm.b + y * ctm.d;
                        return { x: xn, y: yn };
                    }
                    var subprocess = document.getElementById(t),
                        cx = +subprocess.getAttribute('cx'),
                        cy = +subprocess.getAttribute('cy'),
                        ctm = subprocess.getCTM(),
                        coords = getScreenCoords(cx, cy, ctm);
                    // coordsX = coords.x
                    // coordsY = coords.y;
                    if (window.bpmnElement === "flowselect") {
                        endtype = "subprocess";
                        endid = t;
                        // endx = coords.x - 30;
                        endx = coords.x - 20;
                        endy = coords.y;
                        midx = startx + ((endx - startx) / 2);
                    }
                })
            if (eid === null) {
                eid = 'subprocess' + idsubprocess;
            }
            EventBPMNJsonCreator(eid, xvalue, yvalue, 20, 20, "subprocess", subElement);
            subElement = null;
 }

 