"use strict";
var flowcreator = function (eid,fromjson=null){
console.log('formjson '+fromjson);
console.log(' Flow COORDS X :'+coordsX +' ## Flow COORDS Y'+ coordsY);
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
        if(fromjson=='Y'){
	        var strPoints = 'M'+startx + ','+ starty;
	        if( endx >  startx ){
	            var newMidPts = (startx + ((endx - startx)/2) );
	            if( coordsY < (starty + 60 ) ){
	                strPoints += ' L'+ newMidPts +','+ starty;
	                //strPoints += ' L'+ newMidPts +','+ endy;
	                strPoints += ' L'+ endx +','+ endy;
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
	        
        }else{
        	var strPoints = 'M'+startx + ','+ starty;
	        if( endx >  startx ){
	            var newMidPts = (startx + ((endx - startx)/2) );
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
        }
        //var pathPoints = 'M'+startx + ','+ starty + ' L'+ endx +','+ endy; //'m 188,120 L270,120 L270,140'
        if(startx > 0 && endx > 0){
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
    poly.attr('points', newPoints);
}