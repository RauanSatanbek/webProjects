var express = require("express");
var cors = require("cors");
var bodyParser = require("body-parser");
var fs = require("fs");
var app = express();

app.use(bodyParser());
app.use(cors());
app.get("/", function(req, res, next) {
    res.send("Hello");
});
app.get("/getName", function(req, res, next) {
    console.log("-----------------getName");
    res.send("Rauan Satanbek");
})
app.listen(3000, function() {
    console.log("Backend started with port 3000");
});