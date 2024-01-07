---
createdAt: 2023-12-26
title: Comando Linux para iniciantes
author: Elissandra 
authorEmail: elissandra.dev@gmail.com
---
Se você é iniciante e está começando do zero como eu, você não pode deixar de ler este artigo bem massa :)

Sou estudante de programação a um ano e durante esse período, felizmente tenho uma orientação muito foda com  meus estudos, mas quando migrei de Windows para Linux, tudo começou a fluir mais, bora lá que eu vou mostrar uma parada bem legal sobre os comandos Linux.

## Comando pwd(Print Working Directory)

Utilizado para descobrir qual diretório atual está sendo usado ao acionar o comando, o terminal exibe o endereço completo do diretório começando pelo root.

Ex: `/home/user/Documents/Projetos/Portfólio-Eli`

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-pwd.jpeg)


## Comando touch

Utilizado para criar arquivos vazios para poder editá-lo depois.

Ex: Supondo que o usuário queira gerar cinco arquivos de texto, ele pode criá-los usando o comando da seguinte forma: 

`touch texto1 texto2 texto3 texto4 texto5`

ou também:

`touch index.html` -> para criar um arquivo vazio com o formato html.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-touch1.jpeg)

Veja como ficou na área de trabalho:

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-touch2.jpeg)


## Comando ls

Utilizado para listar arquivos e diretórios do sistema. Ao digitar ls no terminal sem adicionar nenhuma opção, serão exibidos na tela todos os itens em formato básico (tipo, tamanho, permissões etc.). 

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-ls.jpeg)

Caso utilize a opção -l, mostrará os detalhes mencionados acima e outras informações, como data e hora de modificação e o proprietário do arquivo / diretório. 

Ex: `ls -l`.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-ls-l.jpeg)

Porém ainda há arquivos que não apareçem nos resultados por conta de serem ocultos. Como visualizá-los sem modificar as suas propriedades no gerenciador de arquivos? Basta digitar `ls -la`.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-ls-la.jpeg)

## Comando cd (Change Directory)

Utilizado para navegar entre as pastas. 

Ex: podemos acessar um diretório ao digitar o comando cd seguido do caminho desejado.
`cd /home/user/Documents`
Caso queira voltar para o diretório anterior, basta inserir `cd .. /home/user/Documents` ou 
 `cd -/usr/share`.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-cd.jpeg)

## Comando clear

Dependendo do processo e da quantidade de tarefas no terminal, a tela pode ficar cheia de informações, e às vezes, o iniciante reinicia o programa para limpá-la. Se você costuma fazer isso, experimente digitar o comando `clear` ou `Ctrl + L` (sem qualquer complemento) para resolver o problema.

Antes:

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-clear1.jpeg)

Após com o comando clear (Ctrl+L)

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-clear2.jpeg)


## Comando mkdir (make directory)

Utilizado para criar uma pasta dentro do terminal 

Ex: `mkdir artigo`

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-mkdir.jpeg)


## Comando code .

Utilizado para abrir o vscode ou abrir na mesma pasta que está sendo utilizada no diretório.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-code.jpeg)


## Comando nano

É um editor de texto baseado em um terminal popular e versátil para Linux e também pode ser usado para pesquisar uma frase específica no texto.

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-editor1.jpeg)

![Alt text](/assets/images/posts/comando-linux-para-iniciantes-phpsp/comando-editor2.jpeg)



## Comando exit

Permite terminar a sessão existente no terminal. Executar após terminar atividades. (Fecha o terminal)

Por fim, há tantos outros comandos legais que eu gostaria de mostrar, mas esticaria muito a leitura, espero que tenham curtido! Até mais :)
