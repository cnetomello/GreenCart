                   var comprarBotoes = document.querySelectorAll('.comprar-botao');
                    comprarBotoes.forEach(function(button) {
                        button.addEventListener('click', function() {
                            var target = this.dataset.target;
                            var popup = document.getElementById(target);
                            if (popup) {
                                popup.style.display = 'block';

                                var produtoNome = button.dataset.productNome;
                                var anuncioIdProduto = button.dataset.productId;
                                var qtdProdutoMax = button.dataset.productQtd;

                                document.getElementById('popup-produto-nome').innerHTML= produtoNome;

                                var produtoId = document.getElementById('produto_id_' + anuncioIdProduto).value;
                                document.getElementById('produto_id').value = produtoId;

                                var qtdProduto = document.getElementById('qtd_produto_' + qtdProdutoMax).value;
                                document.getElementById('qtd_produto').placeholder = "max: " + qtdProduto;
                                document.getElementById('qtd_produto').max = qtdProduto;
                                

                                // Exibir os valores no console para verificar se estão corretos
                                console.log('Produto Nome: ', produtoNome);
                                console.log('Produto ID: ', produtoId);
                                console.log('Produto qtd: ', qtdProduto);
                            }
                        });
                    });

                    
                    function voltar(){
                        var popup = document.getElementById("popup1");
                        popup.style.display = 'none';
                        document.getElementById('qtd_produto').value = null;



                            
                    }