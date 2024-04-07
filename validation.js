const validation= new JustValidate("#signal");

    validation

    .addField("#name",[
{
    rule: "required"
}
    ])

    .addField("#e_mail",[
        {
            rule: "required"
        } ,
            
            {
                rule:"email"
            }, 
            {
                validator: (value) => () =>{
                    return fetch("validate-email.php?email=" + encodeURIComponent(value))
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        return json.available;

                    });
                }
                errorMessage:"email already"
            }
        ])

        .addField("#password",[
            {
                rule: "required"
            } ,
            {
                rule:"password"
            }
                ])
                .addField("#password_confimation",[
                    {
                       validator:(value, fields) =>{
                        return value === fields["#password"].elem.value;
                       },
                       errorMessage:"password should match"
                    } 
                        
                       
                    ])
                    .onSuccess((event)=>{
                        document.getElementById("signal"). submit();
                    

            
                    });