function checkInput(input){

    var x = document.getElementsByName("duration");

    if(isNaN(input)){
        console.log(x);
        alert("Must input number");
        return false;
    }
    return true;
}