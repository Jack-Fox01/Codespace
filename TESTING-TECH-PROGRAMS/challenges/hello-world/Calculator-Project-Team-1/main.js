// Variables to store the sum and the number currently being typed
let sum = "";
let currentNum = "";
let justEvaluated = false; // NEW: tracks if last action was "="

// =======================
// Parent class Button
// =======================
class Button {
    constructor(id){
        this._id = id;
        this.element = document.getElementById(id);
    }

    listenerAction(){}

    addListener(){
        this.element.addEventListener("click", this.listenerAction);
    }

    updateScreen(newOutput){
        document.getElementById("screen").innerHTML = newOutput;
    }
}

// =======================
// Number formatting helper 
// =======================
function formatResult(num) {
    if (Number.isInteger(num)) return num.toString();

    // Limit to 8 decimal places and strip trailing zeros
    return parseFloat(num.toFixed(8)).toString();
}

// =======================
// Number buttons
// =======================
class Numberbutton extends Button {
    constructor(id){
        super(id);
        this.listenerAction = this.listenerAction.bind(this);
        this.number = id;
    }

    listenerAction(){
        // If last action was "=", start fresh
        if (justEvaluated) {
            sum = "";
            currentNum = "";
            justEvaluated = false;
        }

        sum += this.number.toString();
        currentNum += this.number.toString();
        this.updateScreen(currentNum);
    }
}

// Generate number buttons 0-9
for(let i = 0; i < 10; i++){
    new Numberbutton(i).addListener();
}

// =======================
// Decimal button
// =======================
class DecimalButton extends Button {
    constructor(id){
        super(id);
        this.listenerAction = this.listenerAction.bind(this);
    }

    listenerAction(){
        if (justEvaluated) {
            sum = "0";
            currentNum = "0";
            justEvaluated = false;
        }

        // Prevent multiple decimals in the same number
        if (currentNum.includes(".")) return;

        if (currentNum === "") {
            currentNum = "0.";
            sum += "0.";
        } else {
            currentNum += ".";
            sum += ".";
        }

        this.updateScreen(currentNum);
    }
}

// =======================
// Operator buttons
// =======================

// Addition
class AddButton extends Button {
    constructor(id){
        super(id);
        this.listenerAction = this.listenerAction.bind(this);
    }
    listenerAction(){
        if (currentNum === "" && !justEvaluated) return;
        sum += "+";
        currentNum = "";
        justEvaluated = false;
    }
}

// Subtraction
class SubtractButton extends Button {
    constructor(id){
        super(id);
        this.listenerAction = this.listenerAction.bind(this);
    }
    listenerAction(){
        if (currentNum === "" && !justEvaluated) return;
        sum += "-";
        currentNum = "";
        justEvaluated = false;
    }
}

// Division
class DivisionButton extends Button {
    constructor(id){
        super(id);
        this.listenerAction = this.listenerAction.bind(this);
    }
    listenerAction(){
        if (currentNum === "" && !justEvaluated) return;
        sum += "/";
        currentNum = "";
        justEvaluated = false;
    }
}

// Multiplication
class MultiplyButton extends Button {
    constructor(id){
        super(id);
        this.listenerAction = this.listenerAction.bind(this);
    }
    listenerAction(){
        if (currentNum === "" && !justEvaluated) return;
        sum += "*";
        currentNum = "";
        justEvaluated = false;
    }
}

// Modulus
class ModulusButton extends Button {
    constructor(id){
        super(id);
        this.listenerAction = this.listenerAction.bind(this);
    }
    listenerAction(){
        if (currentNum === "" && !justEvaluated) return;
        sum += "%";
        currentNum = "";
        justEvaluated = false;
    }
}

// =======================
// Equals and Clear buttons
// =======================
class EqualsButton extends Button {
    constructor(id){
        super(id);
        this.listenerAction = this.listenerAction.bind(this);
    }

    listenerAction(){
        try {
            if (sum.includes("/0")) {
                this.updateScreen("Error");
                resetCalculator();
                return;
            }

            const rawResult = eval(sum);
            const formattedResult = formatResult(rawResult);

            this.updateScreen(formattedResult);
            sum = formattedResult;
            currentNum = "";
            justEvaluated = true; // marks that evaluation happened

        } catch {
            this.updateScreen("Error");
            resetCalculator();
        }
    }
}

class ClearButton extends Button {
    constructor(id){
        super(id);
        this.listenerAction = this.listenerAction.bind(this);
    }
    listenerAction(){
        resetCalculator();
        this.updateScreen("0");
    }
}

// Reset helper
function resetCalculator(){
    sum = "";
    currentNum = "";
    justEvaluated = false;
}

// =======================
// Instantiate all buttons
// =======================
new AddButton("+").addListener();
new SubtractButton("-").addListener();
new DivisionButton("/").addListener();
new MultiplyButton("*").addListener();
new ModulusButton("%").addListener();
new EqualsButton("=").addListener();
new ClearButton("C").addListener();
new DecimalButton(".").addListener();
