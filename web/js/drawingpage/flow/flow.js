"use strict";
var flowcreator = function (eid){
     console.log("startx : "+ startx);
     console.log("starty : "+ starty);
     console.log("midx : "+ midx);
     console.log("endx : "+ endx);
     console.log("endy : "+ endy);
    var xdeficit = 30;
    var ydeficit = 30;
    if(midx == 0 ||  endx == 0 || endy == 0 || startx == 0 || starty == 0){
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
        
        
        var strPoints = 'M'+startx + ','+ starty;
        if( endx >  startx ){
            if( endy >  starty ){
                strPoints += ' L'+ endx +','+ starty;
            } else if( endy <  starty ){
                strPoints += ' L'+ endx +','+ starty;
            }
        } else if( endx <  startx ){
            if( endy >  starty ){
                strPoints += ' L'+ endx +','+ starty;
            } else if( endy <  starty ){
                strPoints += ' L'+ endx +','+ starty;
            }
        }
        strPoints += ' L'+ endx +','+ endy;
        
        console.log( 'PRINCE  :  '+strPoints);
    
        var pathPoints = strPoints;
        sampleSVGflow.append('path')
                    .attr("id", eid)
                    .attr("marker-end", "url(#triangle"+idflow+")")
                    .attr("d", pathPoints )
                    .attr("stroke", "black")
                    .attr("stroke-width", 2)
                    .attr("fill", "none")
                
                    
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
     console.log('dragging');
    if(drawing) return;
    var dragCircle = d3.select(this), newPoints = [], circle;
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
