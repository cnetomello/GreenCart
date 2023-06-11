var avaliarPedido = document.querySelectorAll('.btn-avaliar');
                    avaliarPedido.forEach(function(button) {
                        button.addEventListener('click', function() {
                            var target = this.dataset.target;
                            var popup = document.getElementById(target);
                            if (popup) {
                                popup.style.display = 'block';

                                var idPedido = button.dataset.idPedido;
                                var idComprador = button.dataset.idComprador;
                                var preco_total = button.dataset.precoPedido;
                                var nome_produto = button.dataset.nomeProduto;
                                var data_pedido = button.dataset.datePedido;
                                

                               document.getElementById("id_pedido_popup").innerHTML= idPedido;

                               document.getElementById("idPedido_avaliacao").value = idPedido;

                               document.getElementById("nome_prod_avaliacao").innerHTML=nome_produto;
                                
                              document.getElementById("data_pedido_avaliacao").innerHTML=data_pedido;
                            
                               
                                document.getElementById('preco_value').value = preco_total;
                                console.log("R$"+ preco_total);
                                

                            }   
                        });
                    });

                    
                    function voltar(){
                        var popup = document.getElementById("popup-avaliar");
                        document.getElementById("one").className="fa fa-star fa-2x";
                        document.getElementById("two").className="fa fa-star fa-2x";
                        document.getElementById("three").className="fa fa-star fa-2x";
                        document.getElementById("four").className="fa fa-star fa-2x";
                        document.getElementById("five").className="fa fa-star fa-2x";
                        document.getElementById("number_stars").value = "";
                        popup.style.display = 'none';
                        
                        


                            
                    }