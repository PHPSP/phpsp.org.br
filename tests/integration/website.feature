Feature: Website - itens que devem estar presentes em todas as páginas

  Scenario Outline:
    Em todas as páginas do website phpsp.org.br os seguintes elementos devem ser respeitados:

    - O snippet do Google Analytics deve estar presente
    - O título deve ser prefixado com "PHPSP |"
    - Links sociais devem estar presentes na barra de navegação

    Given I am on "%url%"
    Then I should see text matching "gtag\('config', 'UA-7974451-1'\)"

    # Barra de Título
    And I should see "PHPSP |" in the "title" element

    # Barra de Navegação
    And I should see an "#navbar a[href='https://github.com/phpsp']" element
    And I should see an "#navbar a[href='https://twitter.com/phpsp']" element
    And I should see an "#navbar a[href='https://bit.ly/vemproslackphpsp']" element
    Examples:
      | url |
      | / |
      | /a-comunidade |
      | /quem-e-a-comunidade |
      | /codigo-de-conduta |
      | /artigos |
      | /artigos |
      | /codigo-de-conduta-para-eventos |
      | /como-contribuir |
      | /como-contribuir |
      | /artigos/notebooks-jupyter-em-php-alem-do-python-sim-e-possivel-veja-como-fazer |
