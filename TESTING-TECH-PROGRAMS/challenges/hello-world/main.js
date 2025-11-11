let students = [
    {name: "Matthew", grade: 90},
    {name: "Mark", grade: 75},
    {name: "Xenia", grade: 88},
    {name: "Fotini", grade: 92},
    {name: "John", grade: 78},
];

// Funciton to print all students and their grades.
function printAllStudents(students) {
     for (let i = 0; i < students.length; i++) {
         console.log(`${students[i].name}: ${students[i].grade}`);
     }
};

// Function to calculate the average score
function calculateAverage(students) {
    let total = 0;
    for (let i = 0; i < students.length; i++){
        total += students[i].grade;
    }
    return total / students.length
};

// Test code
console.log("Initial students:");
printAllStudents(students);
console.log("Average grade:", calculateAverage(students));

// Add new student with '.push'
students.push({name: "Levi", grade: 95}) // .push adds in a new element in the array.

//change the second student's grade to 85
students[1].grade = 85;

console.log("\nUpdated students:");
printAllStudents(students);
console.log("New average grade:", calculateAverage(students));
