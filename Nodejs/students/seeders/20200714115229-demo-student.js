'use strict';
const faker=require('faker');

let generateStudent=(count)=>{
  let students=[];

for(let i=0;i<count;i++){
students.push({
name:faker.name.firstName,
address:faker.address.streetAddress(),
createdAt:new Date(),
updatedAt:new Date()
});
 }
 return students;
}

module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.bulkInsert('students',generateStudent(20),{});
  },

  down:(queryInterface, Sequelize) => {
    return queryInterface.bulkDelete('student',null,{});
  }
};
