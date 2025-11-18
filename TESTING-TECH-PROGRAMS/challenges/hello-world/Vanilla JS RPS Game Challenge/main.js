const choices = ["rock", "paper", "scissors"];

// Get the buttons from the DOM.
const rockBtn = document.getElementById('rock');
const paperBtn = document.getElementById('paper');
const scissorsBtn = document.getElementById('scissors');

// Display elements.
const playerDisplay = document.getElementById("playerDisplay");
const computerDisplay = document.getElementById("computerDisplay");
const resultDisplay = document.getElementById("resultDisplay");


rockBtn.addEventListener('click', () => playGame("rock"));
paperBtn.addEventListener('click', () => playGame("paper"));
scissorsBtn.addEventListener('click', () => playGame("scissors"));

let playGame = playerChoice => {
    const computerChoice = choices[Math.floor(Math.random() * 3)];
    let result = "";

    if(playerChoice === computerChoice){
        result = "Tie!";
    }
    else{
        switch(playerChoice){
            case "rock":
                result = (computerChoice === "scissors") ? "You Win! :D" : "You Lose! :C";
                break;
            case "paper":
                result = (computerChoice === "rock") ? "You Win! :D" : "You Lose! :C";
                break;
            case "scissors":
                result = (computerChoice === "paper") ? "You Win! :D" : "You Lose! :C";
                break;
        }
    }

    playerDisplay.textContent = `Player: ${playerChoice}`;
    computerDisplay.textContent = `Computer: ${computerChoice}`;
    resultDisplay.textContent = result;
};
