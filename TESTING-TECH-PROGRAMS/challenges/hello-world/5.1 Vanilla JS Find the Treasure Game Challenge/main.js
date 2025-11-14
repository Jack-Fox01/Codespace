const choices = ["door1", "door2", "door3"];
const playerDisplay = document.getElementById("playerDisplay");
const computerDisplay = document.getElementById("computerDisplay");
const resultDisplay = document.getElementById("resultDisplay");
const playerScoreDisplay = document.getElementById("playerScoreDisplay");
const computerScoreDisplay = document.getElementById("computerScoreDisplay");
const jonesScoreDisplay = document.getElementById("jonesScoreDisplay");
let playerScore = 0;
let computerScore = 0;
let jonesScore = 0;

let playGame = playerChoice => {
    
    const computerChoice = choices[Math.floor(Math.random() * 3)];
    let result = " ";

    if (playerChoice === computerChoice) {
        result = "You've been caught by the British Royal Navy!🇬🇧";
    }
    else {
        switch(playerChoice){
            case "door1":
                result = (computerChoice === "door3") ? "Ahoy, Plenty  o' bounty!💰" : "Davey Jones! Run!!🏴‍☠️🦜";
                break;
            case "door2":
                result = (computerChoice === "door1") ? "Ahoy, Plenty  o' bounty!💰" : "Davey Jones! Run!!🏴‍☠️🦜";
                break;
            case "door3":
                result = (computerChoice === "door2") ? "Ahoy, Plenty  o' bounty!💰" : "Davey Jones! Run!!🏴‍☠️🦜";
                break;
        }
    }

    playerDisplay.textContent = `Pirate: ${playerChoice}`;
    computerDisplay.textContent = `British Royal Navy: ${computerChoice}`;
    resultDisplay.textContent = result;
    resultDisplay.classList.remove("greenText", "redText");

    switch(result){
        case "Ahoy, Plenty  o' bounty!💰":
            resultDisplay.classList.add("greenText");
            playerScore++;
            playerScoreDisplay.textContent = playerScore;
            break;
        case "You've been caught by the British Royal Navy!🇬🇧":
            resultDisplay.classList.add("redText");
            computerScore++;
            computerScoreDisplay.textContent = computerScore;
            break;
        case "Davey Jones! Run!!🏴‍☠️🦜":
            jonesScore++;
            jonesScoreDisplay.textContent = jonesScore;
        }
}