 // Challenge 1 Done
class User {
    constructor(firstName, lastName) {
        this.firstName = firstName;
        this.lastName = lastName;
    }

    hello() {
        return `Hello, ${this.firstName} ${this.lastName}` ;
    }
}

const user1 = new User("John", "Doe");
// console.log(user1.firstName);
// console.log(user1.lastName);
console.log(user1.hello());

const user2 = new User("Jane", "Doe");
// console.log(user2.firstName);
// console.log(user2.lastName);
console.log(user2.hello()); 

// Challenge 2  DONE
class User {
    constructor(firstName, lastName) {
        this._firstName = firstName;
        this._lastName = lastName;
    }
    get firstName() {
        return this._firstName;
    }
    set firstName(firstName) {
        this._firstName = firstName;
    }
    get lastName() {
        return this._lastName;
    }
    set lastName(lastName) {
        this._lastName = lastName;
    }

    hello() {
        return "Hello, World!";
    }
    iAm() {
        return `My name is ${this.firstName} ${this.lastName}.`;
    }
}

const user = new User("", "");
user.firstName = "Jack";
user.lastName = "Fox";
console.log(user.firstName + " " + user.lastName);
console.log(user.iAm()); 

// Challenge 3 DONE.

class User {
    constructor(userName) {
        this._userName = userName;
    }
    set userName(name) {
        this._userName = name;
    }
    get userName() {
     return this._username;
}

class Admin extends User {

    constructor() {

       super();
}
 
    expressYourRole() {
        return "Admin";
    }
    sayHello() {
        return `Hello admin, ${this._userName}.`;
    }
}

const admin = new Admin("Balthazar"); 
console.log(admin.sayHello());

// Challenge 4 DONE.
class User {
  constructor() {
    this._numberOfArticles = 0;
  }
// this lets you change the number of articles.
  setNumberOfArticles(numberOfArticles) {
    this._numberOfArticles = numberOfArticles;
  }
// this lets you read the number of articles.
  getNumberOfArticles() {
    return this._numberOfArticles;
  }

  calcScores(){
  }
}

class Author extends User {
    calcScores() {
        return this.getNumberOfArticles() * 10 + 20;
    }
}

class Editor extends User {
    calcScores() {
        return this.getNumberOfArticles() * 6 + 15;
    }
}

const Jack = new Author();
Jack.setNumberOfArticles(8);
console.log(Jack.calcScores());

const Frankie = new Editor();
Frankie.setNumberOfArticles(15);
console.log(Frankie.calcScores());


//Challenge 5 DONE

class User {
    constructor(userName) {
        this._userName = userName;
        if (this.constructor === User) {
            throw new Error("Cannot instantiate asbtract class User directly");
        }
    }

    stateYourRole() {
        throw new Error("Abstract method 'stateYourRole must be implemented");
    }
    get userName() {
        return this._userName;
    }
    set userName(userName) {
        this._userName = userName;
    }
}

class Admin extends User {
    stateYourRole() {
        return "admin";
    }
}

class Viewer extends User {
    stateYourRole() {
        return "admin";
    }
}


const admin = new Admin("Balthazar");
console.log(admin.stateYourRole());

const viewer = new Viewer("Melchior");
console.log(viewer.stateYourRole());
