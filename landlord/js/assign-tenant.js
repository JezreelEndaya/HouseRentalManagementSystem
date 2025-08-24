    document.getElementById('apartment-info').addEventListener('change', loadhouses);
    var options = document.getElementById('house-info');

    function loadhouses(){

        var apartmentName = document.getElementById('apartment-info').value;
        var params = "apartmentName="+apartmentName;
        var xhr = new XMLHttpRequest();

        xhr.open('POST','php/assign-tenant.php',true);
        
        xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');
        xhr.onload = function(){
            if(this.status == 200){
                var houses = JSON.parse(this.responseText);

                var option = '';
                for(var i in houses){
                    option += '<option value="'+houses[i]+'">'+houses[i]+'</option>';
                }

                options.innerHTML = option;
            }
        }
        xhr.send(params);
    }