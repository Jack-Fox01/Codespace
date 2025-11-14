/* function resverseString(str) {
    return str.split('').reverse().join('');
}
resverseString("Jack"); */

// Finished Code for task 1
let resverseString = str => {
    return str.split('').reverse().join('');
}
console.log(resverseString('John'));

/* function reverseArray(arr) {
    return arr.reverse();
} */

    // Finished Code for task 2
let reverseArray = arr => {
    return arr.reverse();
}

console.log(reverseArray([1, 2, 3, 4, 5]));
console.log(reverseArray(["I", "Love", "My", "Wife"]));


// Code for Task 3 DONE.

/* const mostExpensiveItem = function(items) {
    let maxItem = items[0];
    let maxValue = items[0].price * items.stock;

    for (let i = 1; i < items.length; i++) {
        const currentValue = items[i].price * items[i].stock;
        if (currentValue > maxValue) {
            maxValue = currentValue;
            maxItem = items[i];
        }
    }

    return maxItem;
} */

/* const drinks = [
    {item: "irn bru", price: 3.25, stock: 50},
    {item: "fanta", price: 3.98, stock: 45},
    {item: "diet coke", price: 4.40, stock: 38},
    {item: "7up", price: 3.99, stock: 42},
]
*/


const mostExpensiveItem = items => {
    let maxItem = items[0];
    let maxValue = items[0].price * items[0].stock;

    for (let i = 1; i < items.length; i++) {
        const currentValue = items[i].price * items[i].stock;
        if (currentValue > maxValue) {
            maxValue = currentValue;
            maxItem = items[i];
        }
    }
    return maxItem;
}

const drinks = [
    {item: "irn bru", price: 3.25, stock: 50},
    {item: "fanta", price: 3.98, stock: 45},
    {item: "diet coke", price: 4.40, stock: 38},
    {item: "7up", price: 3.99, stock: 42},
]

console.log(mostExpensiveItem(drinks));

