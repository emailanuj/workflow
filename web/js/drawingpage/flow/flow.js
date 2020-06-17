"use strict";
var flowcreator = function (eid) {
    if (midx == 0 || endx == 0 || endy == 0 || startx == 0 || starty == 0) {
        return false;
    }
    if (eid === null || eid == undefined) {
        eid = 'flow' + (++idflow);
    }
    var dragger = d3.behavior.drag() //flow drag
        .on('drag', handleDrag)
        .on('dragend', function (d) {
            dragging = false;
        });

    var sampleSVGflow = sampleSVG.append('g')
        .attr("id", "group" + eid);


    // var strPoints = 'M'+startx + ','+ starty;
    // if( endx >  startx ){
    //     if( endy >  starty ){
    //         strPoints += ' L'+ endx +','+ starty;
    //     } else if( endy <  starty ){
    //         strPoints += ' L'+ endx +','+ starty;
    //     }
    // } else if( endx <  startx ){
    //     if( endy >  starty ){
    //         strPoints += ' L'+ endx +','+ starty;
    //     } else if( endy <  starty ){
    //         strPoints += ' L'+ endx +','+ starty;
    //     }
    // }
    // strPoints += ' L'+ endx +','+ endy;


    /*
        Case 1 : ( end.x > start.x ) && ( end.y > start.y )
        Case 2 : ( end.x > start.x ) && ( end.y < start.y )

        Case 3 : ( end.x < start.x ) && ( end.y > start.y )
        Case 4 : ( end.x < start.x ) && ( end.y < start.y )
    */

    var strPoints = 'M' + startx + ',' + starty;

    if (endx > startx) {
        var newMidPts = (startx + ((endx - startx) / 2));
        // console.log('NOT TO GO..'+ coordsY +' @@@@ '+ starty +' @@@ '+ (starty + 60 ));
        if (coordsY < (starty + 60)) {
            strPoints += ' L' + newMidPts + ',' + starty;
            strPoints += ' L' + newMidPts + ',' + endy;
        } else {
            strPoints += ' L' + endx + ',' + starty;
        }
    } else if (endx < startx) {
        var newMidPts = (startx - ((startx - endx) / 2));
        if (coordsY < (starty + 60)) {
            strPoints += ' L' + newMidPts + ',' + starty;
            strPoints += ' L' + newMidPts + ',' + endy;
        } else {
            strPoints += ' L' + endx + ',' + starty;
        }
    }

    strPoints += ' L' + endx + ',' + endy;

    var rectHeight = endy - starty;
    var rectWidth = endx - startx;

    // console.log('PRINCE  :  ' + strPoints);

    var pathPoints = strPoints;
    sampleSVGflow.append('path')
        //.attr("id", eid)
        .attr("marker-end", "url(#triangle" + idflow + ")")
        .attr("d", pathPoints)
        .attr("stroke", "black")
        .attr("stroke-width", 2)
        .attr("fill", "none")

    sampleSVGflow.append("marker")
        .attr("id", "triangle" + idflow)
        .attr("viewBox", "0 0 10 10")
        .attr("refX", "0")
        .attr("refY", "5")
        .attr("markerUnits", "strokeWidth")
        .attr("markerWidth", "5")
        .attr("markerHeight", "4")
        .attr("orient", "auto")
        .append('svg:path')
        .attr('d', 'M 0 0 L 10 5 L 0 10 z')
    sampleSVGflow.append('rect')
        .attr("fill", "transparent")
        .attr("id", eid)
        .attr("x", startx)
        .attr("y", starty)
        .attr("width", rectWidth)
        .attr("height", rectHeight)
        .on("mouseover", function () {
            // console.log('mouse moving');
            // console.log(bpmnjson);
        })
        .on("mouseup", function () {
            // console.log("mouse up");
            var t = d3.select(this).attr("id");
            // console.log(t);
            function getScreenCoords(x, y, ctm) {
                var xn = ctm.e + x * ctm.a + y * ctm.c;
                var yn = ctm.f + x * ctm.b + y * ctm.d;
                return { x: xn, y: yn };
            }

            var circle = document.getElementById(t),
                cx = +circle.getAttribute('x'),
                cy = +circle.getAttribute('y'),
                ctm = circle.getCTM(),
                coords = getScreenCoords(cx, cy, ctm);
            // console.log(coords);
            // console.log(ctm);
            // console.log(coords.x, coords.y);

            tooltipDiv.transition()
                .duration(200)
                .style("opacity", 1.9);
            $(".setting-box").css("display", "block");
            tooltipDiv.html("<input id=" + "trash-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/trash-icon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >" + "&nbsp" + "<input id=" + "property-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/settingsicon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >" + "<input id=" + "text-button" + " type=" + "image" + " title=" + "End Event" + " src=" + baseURL + "/img/review.png" + " alt=" + "Text" + " style=" + "width:25px;" + " >")
                .style("left", coords.x + 30 + "px")
                .style("top", (coords.y - 30) + "px");
            tooltipDiv.select("#trash-button").on("click", function () {
                var groupArrowElement = document.getElementById("groupflow" + idflow);
                groupArrowElement.parentNode.removeChild(groupArrowElement);
                $(".setting-box").css("display", "none");
            });

            tooltipDiv.select("#property-button").on("click", function () {
                tooltipDiv.style("opacity", 0);  
                $(".setting-box").css("display","none"); 
                //console.log(bpmnjson);             
                for (var i = 0; i < bpmnjson.length; i++) {
                    var element = bpmnjson[i];
                    console.log(t);
                    console.log(bpmnjson); //exit;
                    if (element.id === t) {
                        console.log(bpmnjson[i]);
                        selectedId = t;
                        elementType = "flow";
                        elementSubType = element.type;
                        if (element.type === "flow") {
                            selectedId = "F" + t;
                            showFunction(selectedId, element.type);
                        }
                    }
                }
            });

            tooltipDiv.select("#text-button").on("click", function () {
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
                // console.log(t);
                window.selectedtextid = t;
                window.selectedtextx = Math.round(-23);
                window.selectedtexty = Math.round(30);
                //setEventName(selectedtextid, selectedtextx, selectedtexty);               
            });


            // var CircleWidth = this.getBoundingClientRect().width;
            // var CircleHeight = this.getBoundingClientRect().height;

        })
        .on("mouseout", function () {
            console.log('mouse out');
            tooltipDiv.transition()
                .duration(3200)
                .style("opacity", 0)

            setTimeout(function () {
                $('.setting-box').hide(); // or fade, css display however you'd like.
            }, 5000);
        })
        .on("click", function () {
            // console.log("clicking circle...");
            d3.select(this).style("fill", "transparent");
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

        })


    if (startx > 0 && endx > 0 && eid !== 0) {
        console.log('creating flow');
        console.log(eid);
        FlowBPMNJsonCreator(eid, "flow", startid, endid, startx, starty, endx, endy, midx, starttype, endtype);
    }
    starttype = "";
    endtype = "";
    startx = 0;
    starty = 0;
    endx = 0;
    endy = 0;
    startid = 0;
    endid = 0;
    midx = 0;
    points.splice(0);
    drawing = false;
}

function handleDrag() {
    console.log('dragging');
    if (drawing) return;
    var dragCircle = d3.select(this),
        newPoints = [],
        circle;
    dragging = true;
    // console.log(this.parentNode);
    var poly = d3.select(this.parentNode).select('polyline');
    var circles = d3.select(this.parentNode).selectAll('circle');
    // console.log('circle length : '+circles[0].length);
    dragCircle
        .attr('cx', d3.event.x)
        .attr('cy', d3.event.y);
    for (var i = 0; i < circles[0].length; i++) {
        circle = d3.select(circles[0][i]);
        newPoints.push([circle.attr('cx'), circle.attr('cy')]);
    }
    // newPoints = 150,75, 258,137.5, 258,262.5, 150,325, 42,262.6, 42,137.5;
    poly.attr('points', newPoints);
}