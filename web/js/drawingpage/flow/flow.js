"use strict";
var flowcreator = function (eid){


console.log(' Flow COORDS X :'+coordsX +' ## Flow COORDS Y'+ coordsY);

// var flowcreator = function (eid,subElement,svg,startx,starty){
    // console.log("=======================");
    // console.log(bpmnjson);    
    // console.log("=======================");
    // startx = startx + 4;
    // console.log("startid : "+ startid);
    // console.log("startx : "+ startx);
    // console.log("starty : "+ starty);

    // if(d3.event.x > startx){
    //     midx = d3.event.x;
    //     endx = d3.event.x;
    //     endy = d3.event.y;
    // }

    // console.log("midx : "+ midx);
    // console.log("endx : "+ endx);
    // console.log("endy : "+ endy);

    // console.log('#######'+ d3.event.x +'######'+ d3.event.y);

    if(midx == 0 ||  endx == 0 || endy == 0){
        return false;
    } 


    if (eid === null || eid == undefined) {
        eid = 'flow'+(++idflow);
    }

    var dragger = d3.behavior.drag() //flow drag
            .on('drag', handleDrag)
            .on('dragend', function(d){
                dragging = false;
            });

    var sampleSVGflow = sampleSVG.append('g')
    // var sampleSVGflow = svg.append('g')
                        .attr("id", "group"+eid);
    
        sampleSVG.append("marker")
                        .attr("id", "triangle"+idflow)
                        .attr("viewBox", "0 0 10 10")
                        .attr("refX", "0")
                        .attr("refY", "5")
                        .attr("markerUnits", "strokeWidth")
                        .attr("markerWidth", "5")
                        .attr("markerHeight", "4")
                        .attr("orient", "auto")
                        .append('svg:path')
                        .attr('d', 'M 0 0 L 10 5 L 0 10 z');
        
        
        /*
            Case 1 : ( end.x > start.x ) && ( end.y > start.y )
            Case 2 : ( end.x > start.x ) && ( end.y < start.y )

            Case 3 : ( end.x < start.x ) && ( end.y > start.y )
            Case 4 : ( end.x < start.x ) && ( end.y < start.y )
        */
        
        var strPoints = 'M'+startx + ','+ starty;
        
        if( endx >  startx ){
            var newMidPts = (startx + ((endx - startx)/2) );
            // console.log('NOT TO GO..'+ coordsY +' @@@@ '+ starty +' @@@ '+ (starty + 60 ));
            if( coordsY < (starty + 60 ) ){
                strPoints += ' L'+ newMidPts +','+ starty;
                strPoints += ' L'+ newMidPts +','+ endy;
            } else {
                strPoints += ' L'+ endx +','+ starty;
            }
        } else if( endx <  startx ){
            var newMidPts = (startx - (( startx - endx)/2) );
            if( coordsY < (starty + 60 ) ){
                strPoints += ' L'+ newMidPts +','+ starty;
                strPoints += ' L'+ newMidPts +','+ endy;
            } else {
                strPoints += ' L'+ endx +','+ starty;
            }
        }

        strPoints += ' L'+ endx +','+ endy;


        // var pathPoints = 'M'+startx + ','+ starty + ' L'+ endx +','+ endy; //'m 188,120 L270,120 L270,140'
        var pathPoints = strPoints;

        sampleSVGflow.append('path')
                    .attr("id", eid)
                    .attr("marker-end", "url(#triangle"+idflow+")")
                    .attr("d", pathPoints )
                    .attr("stroke", "black")
                    .attr("stroke-width", 2)
                    .attr("fill", "none")
                
                    // sampleSVGflow.append("polyline")      // attach a polyline
                    //     .attr("id", eid)
                    //     .attr("marker-end", "url(#triangle"+idflow+")")
                    //     // .attr("x",midx )
                    //     // .attr("y", starty+((endy-starty)/2))
                    //     .style("stroke", "black")  // colour the line
                    //     .style("fill", "none")     // remove any fill colour
                    //     .style("stroke-width", "2")
                    //     .attr("points", startx + "," + starty + "," + midx + "," + starty + "," + midx + "," + endy + "," + endx + "," + endy)
                    //     .on("mouseup", function () {
                    //         //d3.select(this).style("fill", "aliceblue");
                    //         var t = d3.select(this).attr("id");
                            // console.log('flow Clicked');
                    //         function getScreenCoords(x, y, ctm) {
                    //             var xn = ctm.e + x * ctm.a + y * ctm.c;
                    //             var yn = ctm.f + x * ctm.b + y * ctm.d;
                    //             return {x: xn, y: yn};
                    //         }
                            // console.log("--------")
                            // console.log(t)
                    //         var circle = document.getElementById(t),
                    //             cx = +circle.getAttribute('x'),
                    //             cy = +circle.getAttribute('y'),
                    //             ctm = circle.getCTM(),
                    //             coords = getScreenCoords(cx, cy, ctm);
                            // console.log(coords.x, coords.y);

                    //         tooltipDiv.transition()
                    //             .duration(200)
                    //             .style("opacity", 1.9);

                    //         tooltipDiv.html("<input id=" + "trash-button" + " type=" + "image" + " title=" + "End Event" + " src=" + "img/trash-icon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >"+"&nbsp"+ "<br>" + "<input id=" + "property-button" + " type=" + "image" + " title=" + "End Event" + " src=" + "img/settingsicon.png" + " alt=" + "trash" + " style=" + "width:25px;" + " >")
                    //             .style("left", coords.x  + "px")
                    //             .style("top", coords.y + "px");


                    //         tooltipDiv.select("#trash-button").on("click", function () {
                    //             tooltipDiv.style("opacity", 0);
                    //             deleteElement(t);
                    //             sampleSVG.select("#group"+t).remove(); 
                    //             t=0;
                    //             // semodal.style.display = "block";
                    //         });

                    //         tooltipDiv.select("#property-button").on("click", function () {
                    //             tooltipDiv.style("opacity", 0);
                                // console.log("end evnt button clicked ")
                    //             fmodal.style.display = "block";
                    //         });
                    //     });

                    // sampleSVGflow.append('circle')
                    //             .attr("id", eid)
                    //             .attr('cx', startx)
                    //             .attr('cy', starty)
                    //             .attr('r', 4)
                    //             .attr('stroke', '#ffffff')
                    //             .attr('is-handle', 'true')
                    //             .style({cursor: 'move'})
                    //             .style('opacity',0)
                    //             .call(dragger);

                    // sampleSVGflow.append('circle')
                    //             .attr("id", eid)
                    //             .attr('cx', midx)
                    //             .attr('cy', starty)
                    //             .attr('r', 4)
                    //             .attr('stroke', '#000')
                    //             .attr('is-handle', 'true')
                    //             .style({cursor: 'move'})
                    //             .call(dragger);

                    // sampleSVGflow.append('circle')
                    //             .attr("id", eid)
                    //             .attr('cx', midx)
                    //             .attr('cy', endy)
                    //             .attr('r', 4)
                    //             .attr('stroke', '#000')
                    //             .attr('is-handle', 'true')
                    //             .style({cursor: 'move'})
                    //             .call(dragger);

                    // sampleSVGflow.append('circle')
                    //             .attr("id", eid)
                    //             .attr('cx', endx)
                    //             .attr('cy', endy)
                    //             .attr('r', 4)
                    //             .attr('stroke', '#ffffff')
                    //             .attr('is-handle', 'true')
                    //             .style({cursor: 'move'})
                    //             .style('opacity',0)
                    //             .call(dragger);

                    // console.log(eid + " flow "+ ' => '+ startid + ' => '+ endid + ' => '+ startx+ ' => '+ starty+ ' => '+endx+ ' => '+endy+ ' => '+ midx +' => '+ starttype +' => '+ endtype);
                    
                    if(startx > 0 && endx > 0){
                        FlowBPMNJsonCreator(eid,"flow", startid, endid, startx, starty,endx,endy,midx,starttype,endtype); 
                    }

                    starttype= "";
                    endtype = "";
                    startx = 0;
                    starty = 0;
                    endx = 0;
                    endy = 0;
                    startid =0;
                    endid =0;
                    midx =0;
                    points.splice(0);
                    drawing = false;

 }

 function handleDrag() {
    //  console.log('dragging');
    if(drawing) return;
    var dragCircle = d3.select(this), newPoints = [], circle;
    dragging = true;
    console.log(this.parentNode);

    var poly = d3.select(this.parentNode).select('polyline');
    var circles = d3.select(this.parentNode).selectAll('circle');
    console.log('circle length : '+circles[0].length);
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

