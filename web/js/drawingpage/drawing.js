"use strict";
document.onload = (function (d3, saveAs, Blob, undefined) {
    //id generation numbers
    window.idstartelement = 0;
    window.idendelement = 0;
    window.idtaskelement = 0;
    window.idgatewayelement = 0;
    window.iddatastore = 0;
    window.idsubprocess = 0;
    window.idelement = 0;
    window.idflow = 0;
    // var arrowbuttonclick = 0;
    var taskbuttonclick = 0;
    window.endid = 0;
    window.startid = 0;
    window.starttype = "";
    window.endtype = "";
    window.startx = 0;
    window.starty = 0;
    window.endx = 0;
    window.endy = 0;
    window.midx = 0;

    window.coordsX = 0;
    window.coordsY = 0;

    window.bpmnjson = [];
    window.bpmnElement = null;
    window.subElement = null;
    window.selectedId = 0;

    window.selectedtextid = null;
    window.selectedtextx = 0;
    window.selectedtexty = 0;

    window.dragFlows = [];
    window.dragging = false;
    window.drawing = false;
    window.taskwidth = 0;
    window.inter = false;

    //     window.sampleSVG ;


    //element tooltip div
    window.tooltipDiv = d3.select("#mySvg")
        .append("div")
        .attr("class", 'setting-box')
        .style("position", "absolute")
        .style("z-index", "10")
        .style("opacity", 0);


    // define property creator object
    window.semodal = document.getElementById('SEModal');
    

    var GraphCreator = function (svg, nodes, edges) {
        var thisGraph = this;
        thisGraph.idct = 0;


        thisGraph.nodes = nodes || [];
        thisGraph.edges = edges || [];

        thisGraph.state = {
            selectedNode: null,
            selectedEdge: null,
            mouseDownNode: null,
            mouseDownLink: null,
            justDragged: false,
            justScaleTransGraph: false,
            lastKeyDown: -1,
            shiftNodeDrag: false,
            selectedText: null
        };


        // handle download data
        d3.select("#download-input").on("click", function () {
            console.log("downlaod button clicked")

            var bpmn = [];
            for (var i = 0; i < bpmnjson.length; i++) {
                var bpmnnode = bpmnjson[i];
                if (bpmnnode.id != 0) {
                    bpmn.push(bpmnnode)


                }
            }
            bpmn.push({
                "id": "data",
                "idstartelement": idstartelement,
                "idendelement": idendelement,
                "idgatewayelement": idgatewayelement,
                "idflow": idflow
            });

            
            var blob = new Blob([window.JSON.stringify({
                bpmn
                //  bpmnjson
                // "nodes": thisGraph.nodes,
                // "edges": saveEdges
                // "nodes": "hello",
                //  "edges": "saveEdges"
            })], { type: "text/plain;charset=utf-8" });
            saveAs(blob, "bpmn.json");
        });


        d3.select("#start-button").on("click", function () {
            document.body.style.cursor = "copy";
            console.log("ok circle");
            bpmnElement = "startEvent";
            subElement = "StartEvent";

        });
        d3.select("#start-time-button").on("click", function () {
            document.body.style.cursor = "copy";
            console.log("ok circle");
            bpmnElement = "startEvent";
            subElement = "TimeStartEvent";


        });
        d3.select("#start-message-button").on("click", function () {
            document.body.style.cursor = "copy";
            console.log("ok circle");
            bpmnElement = "startEvent";
            subElement = "MessageStartEvent";


        });
        d3.select("#start-error-button").on("click", function () {
            document.body.style.cursor = "copy";
            console.log("ok circle");
            bpmnElement = "startEvent";
            subElement = "ErrorStartEvent";


        });

        d3.select("#end-button").on("click", function () {
            // console.log("ok circle");
            document.body.style.cursor = "copy";
            bpmnElement = "endEvent";
            subElement = "EndEvent";


        });
        d3.select("#error-end-button").on("click", function () {
            // console.log("ok error");
            document.body.style.cursor = "copy";
            bpmnElement = "endEvent";
            subElement = "ErrorEndEvent";

        });
        d3.select("#cancel-end-button").on("click", function () {
            // console.log("ok circle");
            document.body.style.cursor = "copy";
            bpmnElement = "endEvent";
            subElement = "CancelEndEvent";

        });
        d3.select("#terminate-end-button").on("click", function () {
            // console.log("ok circle");
            document.body.style.cursor = "copy";
            bpmnElement = "endEvent";
            subElement = "TerminateEndEvent";

        });

        d3.select("#user-task-button").on("click", function () {
            document.body.style.cursor = "copy";
            bpmnElement = "task";
            console.log("ok task");
            subElement = "UserTask";
            // Extract the click location\


        });
        d3.select("#script-task-button").on("click", function () {
            document.body.style.cursor = "copy";
            bpmnElement = "task";
            console.log("ok task");
            subElement = "ScriptTask";
            // Extract the click location\


        });
        d3.select("#mail-task-button").on("click", function () {
            document.body.style.cursor = "copy";
            bpmnElement = "task";
            console.log("ok task");
            subElement = "MailTask";
            // Extract the click location\


        });
        d3.select("#manual-task-button").on("click", function () {
            document.body.style.cursor = "copy";
            bpmnElement = "task";
            console.log("ok task");
            subElement = "ManualTask";
            // Extract the click location\


        });
        d3.select("#parallel-gateway-button").on("click", function () {
            console.log("ok gatway");
            document.body.style.cursor = "copy";
            bpmnElement = "gateway";
            subElement = "parallel";


        });
        d3.select("#exclusive-gateway-button").on("click", function () {
            console.log("ok gatway");
            document.body.style.cursor = "copy";
            bpmnElement = "gateway";
            subElement = "exclusive";


        });
        d3.select("#inclusive-gateway-button").on("click", function () {
            console.log("ok gatway");
            document.body.style.cursor = "copy";
            bpmnElement = "gateway";
            subElement = "inclusive";


        });
        d3.select("#event-gateway-button").on("click", function () {
            console.log("ok gatway");
            document.body.style.cursor = "copy";
            bpmnElement = "gateway";
            subElement = "event";


        });
        d3.select("#data-store-button").on("click", function () {
            document.body.style.cursor = "copy";
            console.log("ok Data Store");
            bpmnElement = "datastore";
            subElement = "datastore";

        });
        d3.select("#sub-process-button").on("click", function () {
            document.body.style.cursor = "copy";
            console.log("ok Sub Process");
            bpmnElement = "subprocess";
            subElement = "subprocess";

        });
        d3.select("#arrow-button").on("click", function () {
            document.body.style.cursor = "pointer";
            console.log("arrow button click");
            bpmnElement = "flow";
            // arrowbuttonclick = 1;
        });

        d3.select("#arrow").on("click", function () {
            console.log("ok arrow");
            // models.divider();
            svg.append('path')
                .attr('class', 'link dragline hidden')
                .attr('d', 'M0,0L0,0')
                .style('marker-end', 'url(#mark-end-arrow)');
        });

        d3.select("#upload-input").on("click", function () {
            document.getElementById("hidden-file-upload").click();
        });
        d3.select("#hidden-file-upload").on("change", function () {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                var uploadFile = this.files[0];
                var filereader = new window.FileReader();

                filereader.onload = function () {
                    var txtRes = filereader.result;
                    // TO DO better error handling
                    try {
                        var jsonObj = JSON.parse(txtRes);
                        //  console.log(jsonObj)
                        uploadgraphCreator(jsonObj)

                    } catch (err) {
                        window.alert("Error parsing uploaded file\nerror message: " + err.message);
                        return;
                    }
                };
                filereader.readAsText(uploadFile);

            } else {
                alert("Your browser won't let you save this graph -- try upgrading your browser to IE 10+ or Chrome or Firefox.");
            }

        });

        // handle delete graph
        d3.select("#delete-graph").on("click", function () {
            thisGraph.deleteGraph(false);
        });
    };


    GraphCreator.prototype.setIdCt = function (idct) {
        this.idct = idct;
    };

    GraphCreator.prototype.consts = {
        selectedClass: "selected",
        connectClass: "connect-node",
        circleGClass: "conceptG",
        graphClass: "graph",
        activeEditId: "active-editing",
        BACKSPACE_KEY: 8,
        DELETE_KEY: 46,
        ENTER_KEY: 13,
        nodeRadius: 50
    };

    GraphCreator.prototype.zoomed = function () {
        this.state.justScaleTransGraph = true;
        d3.select("." + this.consts.graphClass)
            .attr("transform", "translate(" + d3.event.translate + ") scale(" + d3.event.scale + ")");
    };


    /**** MAIN ****/
    // warn the user when leaving
    window.onbeforeunload = function () {
        return "Make sure to save your graph locally before leaving :-)";
    };


    var docEl = document.documentElement,
        bodyEl = document.getElementsByTagName('body')[0];


    var cwidth = window.innerWidth || docEl.clientWidth || bodyEl.clientWidth,
        height = window.innerHeight || docEl.clientHeight || bodyEl.clientHeight;

    var xLoc = cwidth / 2 - 25,
        yLoc = 100;

    // initial node data
    var nodes = [{ title: "new concept", id: 0, x: xLoc, y: yLoc },
    { title: "new concept", id: 1, x: xLoc, y: yLoc + 200 }];
    var edges = [{ source: nodes[1], target: nodes[0] }];

    
    var svg = d3.select("#mySvg").append("svg")
        .attr("width", cwidth)
        .attr("height", height);
        // .attr("left", "0");
    // .append('g').attr('class', 'viewport');
    
    svg.on("click", function () {
        console.log("svg onclick")
        console.log(d3.event);
        bpmnEventDivider(bpmnElement, subElement, svg);
        d3.select('body').style("cursor", "auto");
    });

    window.sampleSVG = svg;

    var graph = new GraphCreator(svg, nodes, edges);
    graph.setIdCt(2);

})(window.d3, window.saveAs, window.Blob);
//graph.updateGraph();


