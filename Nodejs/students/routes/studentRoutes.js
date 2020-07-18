const express=require('express');

const studentController=require('../controllers/StudentController');
const route=express.Router();
route.post('/api/v1/student',studentController.newStudent);
route.get('/api/v1/student',studentController.students);
route.get('/api/v1/student/:id',studentController.specificStudent);
route.put('/api/v1/student/:id',studentController.update);
route.delete('/api/v1/student/:id',studentController.delete);

module.exports=route;