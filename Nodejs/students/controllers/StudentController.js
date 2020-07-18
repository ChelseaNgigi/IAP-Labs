const model=require('../models')
exports.newStudent=(req,res,next)=>{
    let full_name=req.body.full_name;
    let address=req.body.address;

    model.Student.create({
        full_name:full_name,
        address:address
    }).then(result=>{
        //return response
        res.send(result);
        res.send("Student details have been saved");
    }).catch(error=>{
        //return response=>Error
        //res.send("S");
        res.send(error);
    });
    exports.students=(req,res,nexr)=>{
        //all students
        model.Student.getAll({
            error,
            result
        }).then(result=>{
            res.send(result);
        }).catch(error=>{
            res.send(error);
        });
    }

    exports.specificStudent=(req,res,nexr)=>{
        //specific student
        model.Student.findById(
            req.params.id,
            (error,result)=>{    
        }).then(result=>{
            res.send(result);
        }).catch(error=>{
            res.send(error);
        });
    }

    exports.update=(req,res,nexr)=>{
        model.Student.updateId(
            req.params.id,
            req.body
        ).then(result=>{
            
            res.send(result);
            res.send("Student details have been updated");
        }).catch(error=>{
            res.send(error);
        });
    }
    exports.delete=(req,res,nexr)=>{
        model.Student.remove(
            req.param.id,
            (error,result)
        ).then(result=>{
            res.send("Student details have been deleted");
        }).catch(error=>{
            res.send(error);
        });
    }
}