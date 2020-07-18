const express=require('express');
const routes=require('./routes/studentRoutes');
const Parser=require('body-parser');

const app=express();

app.use(Parser.urlencoded({extended:true}));
app.use(routes);

app.listen('9000');