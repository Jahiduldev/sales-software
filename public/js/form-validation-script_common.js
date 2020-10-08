var Script = function () {

    $().ready(function() {

	
	
        $("#addModelForm").validate({
            rules: {              
                add_model_code: {
                    required: true                 
                },
                add_model_name: {
                    required: true                
                },
                add_description: {
                    required: true                   
                },
                add_status: {
                    required: true                   
                }
            },
            messages: {          
                add_model_code: {
                    required: "Please enter model code"                 
                }, 
                add_model_name: {
                    required: "Please enter model name"                   
                },				 
                add_description: {
                    required: "Please enter description"                  
                },
                add_status: {
                    required: "Please select status"                  
                }				
            }
        });
		
		
        $("#addZoneForm").validate({
            rules: {              
                add_zone_name: {
                    required: true                 
                },
                add_description: {
                    required: true                
                },
                add_status: {
                    required: true                   
                }
            },
            messages: {          
                add_zone_name: {
                    required: "Please enter zone name"                 
                }, 
                add_description: {
                    required: "Please enter description"                   
                },				 
                add_status: {
                    required: "Please select status"                  
                }				
            }
        });
		
		
		
 
   

        $("#addEmployeeForm").validate({
            rules: {              
                add_employee_code: {
                    required: true                 
                },
                add_employee_type: {
                    required: true                 
                },
                add_employee_name: {
                    required: true                 
                },
                add_phone: {
                    required: true                 
                },
               
                add_address: {
                    required: true                   
                }
            },
            messages: {          
                add_employee_code: {
                    required: "Please enter Employee Code"                 
                }, 
                add_employee_type: {
                    required: "Please enter Employee Type"                   
                },
                add_employee_name: {
                    required: "Please enter Employee name"                 
                }, 
                add_phone: {
                    required: "Please enter Phone Number"                   
                },				
                add_address: {
                    required: "Please select Address"                  
                }				
            }
        });
        
        
        $("#addCustomerForm").validate({
            rules: {

                install_date: {
                    required: true
                },
                salesby: {
                    required: true                 
                },
                installby: {
                    required: true                 
                },
                techzone: {
                    required: true                 
                },
                model: {
                    required: true                 
                },
               
                customer_name: {
                    required: true                   
                },
                address: {
                    required: true                   
                },
                phone: {
                    required: true                   
                }
             
            },
            messages: {
                install_date: {
                    required: "Please select install date"
                },
                salesby: {
                    required: "Please select Sales By"
                }, 
                installby: {
                    required: "Please select Install By"
                },
                techzone: {
                    required: "Please enter Tech Zone"                 
                }, 
                model: {
                    required: "Please select Model"
                },				
                address: {
                    required: "Please Enter Address"                  
                },
                customer_name: {
                    required: "Please Enter Customer Name"                  
                },
                phone: {
                    required: "Please Enter Phone Number"                  
                }
               
            }
        });
		
		


        $("#addServiceForm").validate({
            rules: {

                add_customer_code: {
                    required: true
                },
                add_mobile_number: {
                    required: true
                },
                service_priority: {
                    required: true
                },
                add_request_date: {
                    required: true
                },
                add_service_description: {
                    required: true
                }

           
            },
            messages: {
                add_customer_code: {
                    required: "Please enter customer code"
                },
                add_mobile_number: {
                    required: "Please enter mobile number"
                },
                service_priority: {
                    required: "Please select service priority"
                },
                add_request_date: {
                    required: "Please select request date"
                },
                add_service_description: {
                    required: "Please enter service description"
                }
             
            }
        });





 $("#addCompletedServiceForm").validate({
            rules: {

                add_notes: {
                    required: true
                }
              



            },
            messages: {
                add_notes: {
                    required: "Please enter notes about service"
                }
              


            }
        });





 
    });

}();