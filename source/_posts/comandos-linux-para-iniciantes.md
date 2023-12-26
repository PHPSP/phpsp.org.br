---
createdAt: 2023-12-26
title: Comando Linux para iniciantes
author: Elissandra 
authorEmail: elissandra.dev@gmail.com
---
Se você é iniciante e está começando do zero como eu, você não pode deixar de ler este artigo bem massa :)

Sou estudante de programação a um ano e durante esse período, felizmente tenho uma orientação muito foda com os meus estudos, mas quando migrei de Windows para Linux, tudo começou a fluir mais, bora lá que eu vou mostrar uma parada bem legal sobre os comandos Linux.

pwd (Print Working Directory): Usado para descobrir qual diretório atual está sendo utilizado ao acionar o comando, o terminal exibe o endereço completo do diretório começando pelo root.
Ex: /home/user/Documents/Projetos/Portfólio-Eli

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-pwd.jpeg)


touch: É usado para criar arquivos vazios para poder editá-lo depois.
Ex: Supondo que o usuário queira gerar cinco arquivos de texto, ele pode criá-los usando o comando da seguinte forma: 
touch texto1 texto2 texto3 texto4 texto5
ou também:
touch index.html -> para criar um arquivo vazio com o formato html.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-touch1.jpeg)

Veja como ficou na área de trabalho:

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-touch2.jpeg)


 ls: É usado para listar arquivos e diretórios do sistema. Se digitar ls no terminal sem adicionar nenhuma opção, serão exibidos na tela todos os itens em formato básico (tipo, tamanho, permissões etc.). 

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-ls.jpeg)

Caso utilize a opção -l, mostrará os detalhes mencionados acima e outras informações, como data e hora de modificação e o proprietário do arquivo / diretório. 
Ex: ls -l.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-ls-l.jpeg)



Porém ainda há arquivos que não apareçam nos resultados por conta de eles serem ocultos. Como visualizá-los sem modificar as suas propriedades no gerenciador de arquivos? Basta digitar ls -la.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-ls-la.jpeg)

cd (Change Directory): Usado para navegar entre as pastas. 
Ex: podemos acessar um diretório ao digitar o comando cd seguido do caminho desejado.
cd /home/user/Documents
E se quiser voltar para o diretório em que estava antes, basta inserir cd .. /home/user/Documents cd -
/usr/share

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-cd.jpeg)

clear
Dependendo do processo e da quantidade de tarefas no terminal, a tela pode ficar cheia de informações, e às vezes, o iniciante reinicia o programa para limpá-la. Se você costuma fazer isso, experimente digitar o comando clear ou Ctrl + L (sem qualquer complemento) para resolver o problema
Antes:

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-clear1.jpeg)

Depois com o comando clear (Ctrl+L)

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-clear2.jpeg)


mkdir (make directory): Usado para criar uma pasta dentro do terminal 
Ex: elissandra@elissandra-Lenovo-IdeaPad-S400:~$ mkdir artigo

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-mkdir.jpeg)


code .: Abrir o vscode ou abrir na mesma pasta que está sendo utilizada no diretório.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-code.jpeg)


nano: Editor de texto baseado em um terminal popular e versátil para Linux e também pode ser usado para pesquisar uma frase específica no texto.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-editor1.jpeg)

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-editor2.jpeg)



exit: Permite terminar a sessão existente no terminal. Executar após terminar atividades. (Fecha o terminal)

Por fim, há tantos outros comandos legais que eu gostaria de mostrar, mas esticaria muito a leitura, espero que tenham curtido! Até mais :)
