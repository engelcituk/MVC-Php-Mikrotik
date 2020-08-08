
showVouchers();

function showVouchers() {
  if(localStorage.getItem('listaTicketsMK')){
    listadoTickets = JSON.parse(localStorage.getItem('listaTicketsMK')); //convierto a json
    if(listadoTickets.length > 0){
        contador=1;
        for (let i = 0; i < listadoTickets.length; i++) {

            name = listadoTickets[i]['name'];
            password = listadoTickets[i]['password'];
            profile = listadoTickets[i]['profile'];
            limitUptime = listadoTickets[i]['limitUptime'];
            comment = listadoTickets[i]['comment'];

            ticket = `
                <table style="display: inline-block; width: 250px; border: 1px solid #121DAE; line-height: 110%; font-family: arial; font-size: 12px; margin: 1px;">     
                    <tbody>         
                        <tr>             
                            <td style="text-align: center; color: #2F38F4; font-size: 13px; border-bottom: 1px #ccc solid;"><b>ABARROTES WILMA</b></td>        
                        </tr>          
                        <tr>              
                            <td>                   
                                <table style=" text-align: center; width: 240px; background-color: #fff; line-height: 110%; font-size: 11px;">              
                                    <tbody>                
                                        <tr style="background-color: #eee;">                               
                                            <td style="background-color: #fff; width: 33%"><b>Número</b></td>                               
                                            <td style="width: 33%"><b>Paquete</b></td>                                 
                                            <td style="width: 33%">Datos</td>                            
                                        </tr>                           
                                        <tr>                              
                                            <td ><b>${contador}</b></td>                              
                                            <td><b>${profile}</b></td>                              
                                            <td>Ilimitados</td>                   
                                        </tr>                       
                                    </tbody>                  
                                </table>           
                            </td>             
                        </tr>             
                        <tr>       
                            <td>                  
                                    <table style=" text-align: center; width: 240px; background-color: #fff; line-height: 110%; font-size: 11px;">               
                                        <tbody>                         
                                            <tr style="background-color: #eee;">                             
                                                <td style="width: 33%">Tiempo</td>                             
                                                <td style="width: 33%"></td>                             
                                                <td style="width: 33%">Precio</td>                         
                                            </tr>                         
                                            <tr>                        
                                                <td> ${limitUptime}</td>                             
                                                <td></td>                             
                                                <td>$ ${comment}</td>
                                            </tr>                     
                                    </tbody>                   
                                </table>                
                            </td>              
                        </tr>              
                        <tr>                 
                            <td>                      
                                <table style=" text-align: center; width: 240px; background-color: #fff; line-height: 110%; font-size: 12px; border-top: 1px solid #ccc;">    
                                    <tbody>                             
                                        <tr style="color: #1A16B8; font-size: 11px;">                       
                                            <td style="width: 50%">Usuario</td>                          
                                            <td>Contraseña</td>                   
                                        </tr>                         
                                        <tr style="background-color: #fff;">                                
                                            <td style="color: #000000; border: 1px #ccc solid;">${name}</td>                               
                                            <td style="color: #000000; border: 1px #ccc solid;">${password}</td>                                
                                        </tr>                          
                                    </tbody>                      
                                </table>                 
                            </td>              
                        </tr>              
                        <tr>                   
                            <td style="text-align: center; font-size:11px;">Mas tickets en Abarrotes Wilma</td>             
                            </tr>      
                        </tbody>     
                </table>
            `;          
            contador ++;
            $("#vouchers").append(ticket);
        }
    }
  }    
}