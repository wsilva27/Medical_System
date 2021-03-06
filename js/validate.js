var validator = new function(){
    this.isNotNull = function(obj){
        var regex = /[A-Za-z0-9-]{1}/;
        return this.get(obj, regex);
    };
    
    this.isZip = function(obj){
        var regex = /^\d{5}(?:[-\s]\d{4})?$/;
        return this.get(obj, regex);
    };
    
    this.isNumber = function(obj){
        var regex = /\d*/;
        return this.get(obj, regex);
    };
    
    this.get = function(obj, regex){
        obj.removeClass('is-invalid');
        obj.removeClass('is-valid');
        if(!regex.test(obj.val())){
            obj.addClass('is-invalid');
            return false;
        }
        else{
            obj.addClass('is-valid');
            return true;
        }
        
    };
    
    this.makeError = function(obj){
        obj.removeClass('is-invalid');
        obj.removeClass('is-valid');
        obj.addClass('is-invalid');
        return false;
    };
    
    this.exist = function(obj){
        obj.removeClass('is-invalid');
        obj.removeClass('is-valid');
        obj.addClass('is-invalid');
        return false;
    };
};