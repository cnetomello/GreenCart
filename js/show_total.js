document.getElementById("qtd_produto").addEventListener("input",function() {
    var precio2;
    var cantidad2;
    var total2;
    precio2 = document.getElementById('preco').value;
    cantidad2 = document.getElementById('qtd_produto').value;
    total2 = precio2 * cantidad2;
    document.getElementById('Valor_total').innerHTML = total2.toFixed(2);
  
  });