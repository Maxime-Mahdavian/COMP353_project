function checkInput(input, field){

    if(isNaN(input)){
        alert("Must input number for " + field);
        return false;
    }
    return true;
}
