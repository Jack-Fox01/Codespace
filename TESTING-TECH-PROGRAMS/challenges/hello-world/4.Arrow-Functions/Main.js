// Task one DONE    
let greet = name => "Hello my name " + name;

console.log(greet("Chad"));
console.log(greet("Finbar"));

/*function isEven(num) {
  return num % 2 === 0;
}*/

/* let isEven = function(num){
    return num % 2 === 0;
}*/

// Task two DONE
let isEven = num => num % 2 === 0; 
console.log(isEven())

// Task three DONE
/* function counterFunc(counter) {
  if (counter > 100) {
    counter = 0;
  } else {
    counter++;
  }
  return counter;
} */

// console.log(counterFunc());

/* let counterFunc = function(counter){
    // for (let i = 0; i < counter.length; i++);
    if (counter > 100) {
        counter = 0;
    } else {
        counter++;
    }
    return counter;
} */

let counterFunc = counter => {
    if (counter > 100) {
        counter = 0;
    } else {
        counter++
    }
    return counter;
}

console.log(counterFunc(2));

// Task Four DONE

/* function nameAge(name, age) {
    console.log("Hello " + name);
    console.log("You are " + age + " years old");
} */

/* let nameAge = function(name, age) {
    console.log("Hello " + name);
    console.log("You are " + age + " years old");
} */

let name = (name, age) => {
    console.log("Hello " + name);
    console.log("You are " + age + " years old");
}

console.log("Jack", 26);

// task 5 DONE

/* function printOnly() {
  console.log("printing");
} */

/* let printOnly = function() {
    console.log("Printing")
} */

let printOnly = () => {
    console.log("Printing")
}

console.log(printOnly());

//Taks 6 DONE
/* function sum(num1, num2) {
    return num1 + num2
} */

/* let sum = function(num1, num2) {
    return num1 + num2
} */ 

let sum = (num1, num2) => {
    return num1 + num2
}

console.log(sum(1,6));
