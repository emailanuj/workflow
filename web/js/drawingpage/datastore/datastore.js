"use strict";
var textWidth = 100, textHeight = 30, dragbarw = 20;
var datastoredevider = function (eid,subElement,svg,xvalue,yvalue){
var group = svg.append('g')
        .attr('transform', 'translate(' + xvalue + ',' + yvalue + ')')
        .attr('id', 'datastore' + (++iddatastore))
        .call(drag);
        
            group.append("path")
                .attr("fill", "#ffffff")
                .attr("stroke", "#808080")
                .attr("d", "m  0,6.65l  0,36.885245901639344 c  1.639344262295082,8.196721311475411, 47.540983606557376,8.196721311475411, 49.18032786885246,0 l  0,-36.885245901639344 c -1.639344262295082,-8.196721311475411, -47.540983606557376,-8.196721311475411, -49.18032786885246,0 c  1.639344262295082,8.196721311475411, 47.540983606557376,8.196721311475411, 49.18032786885246,0 m  -49.18032786885246,5.737704918032787 c  1.639344262295082,8.196721311475411, 47.540983606557376,8.196721311475411, 49.18032786885246,0 m  -49.18032786885246,5.737704918032787 c  1.639344262295082,8.196721311475411, 47.540983606557376,8.196721311475411, 49.18032786885246,0")
                .attr("stroke-width", "1.5")
                .attr("stroke-linecap", "round")
                .attr("stroke-linejoin", "round")
                .attr("stroke-opacity", "1")
                .style("fill", "white")
                .style("stroke-width", "2px")
                .style("stroke", "black")
                .style("fill-opacity", 0.95);
            group.append('rect')
                .attr('id', 'datastore' + iddatastore)
                .style("fill", "white")
                .style("width", "50px")
                .style("height", "50px")                
                .style("fill-opacity", 0)
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
                    var datastore = document.getElementById(t),
                        cx = +datastore.getAttribute('cx'),
                        cy = +datastore.getAttribute('cy'),
                        ctm = datastore.getCTM(),
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
                                elementType = "datastore";
                                elementSubType = element.subtype;
                                if (element.subtype === "datastore") {
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
        
        
                    var CircleWidth = this.getBoundingClientRect().width;
                    var CircleHeight = this.getBoundingClientRect().height;
                    tooltipDiv.select("#arrow-button").on("click", function () {
                        console.log('datastore arrow 1');
                        tooltipDiv.style("opacity", 0);
                        $(".setting-box").css("display","none");
                        // console.log("end arrow button clicked ")
                        starttype = "startEvent";
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
                    var datastore = document.getElementById(t),
                        cx = +datastore.getAttribute('cx'),
                        cy = +datastore.getAttribute('cy'),
                        ctm = datastore.getCTM(),
                        coords = getScreenCoords(cx, cy, ctm);
                    // coordsX = coords.x
                    // coordsY = coords.y;
                    if (window.bpmnElement === "flowselect") {
                        endtype = "endEvent";
                        endid = t;
                        // endx = coords.x - 30;
                        endx = coords.x - 20;
                        endy = coords.y;
                        midx = startx + ((endx - startx) / 2);
                    }
                })
            if (eid === null) {
                eid = 'datastore' + iddatastore;
            }
            EventBPMNJsonCreator(eid, xvalue, yvalue, 20, 20, "datastore", subElement);
            subElement = null;
 }

 