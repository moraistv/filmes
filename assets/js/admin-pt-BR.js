(function () {
  'use strict';

  var translations = {
    'Dashboard': 'Painel',
    'Movies': 'Filmes',
    'Movie': 'Filme',
    'Languages': 'Idiomas',
    'Language': 'Idioma',
    'Genre': 'Gênero',
    'Genres': 'Gêneros',
    'TV Series': 'Séries',
    'Series': 'Série',
    'Season': 'Temporada',
    'Seasons': 'Temporadas',
    'Episode': 'Episódio',
    'Episode List': 'Lista de episódios',
    'Live TV': 'TV ao vivo',
    'Category': 'Categoria',
    'Categories': 'Categorias',
    'Channel': 'Canal',
    'Channels': 'Canais',
    'Users': 'Usuários',
    'User': 'Usuário',
    'Comments': 'Comentários',
    'Reports': 'Denúncias',
    'Report': 'Denúncia',
    'Notification': 'Notificações',
    'SMTP Settings': 'Configurações de SMTP',
    'Settings': 'Configurações',
    'App Settings': 'Aplicativo',
    'Ads Settings': 'Anúncios',
    'API Settings': 'Configurações da API',
    'OMDb API': 'API OMDb',
    'Verify Purchase': 'Verificar licença',
    'API URLS': 'URLs da API',
    'Profile': 'Perfil',
    'Logout': 'Sair',
    'Login': 'Entrar',
    'Username': 'Usuário',
    'Password': 'Senha',
    'Home': 'Início',
    'Shortcut': 'Atalhos',
    'About': 'Sobre',
    'Users Analysis': 'Análise de usuários',
    'New registrations': 'Novos cadastros',
    'No data found !': 'Nenhum dado encontrado!',
    'Admin Profile': 'Perfil do administrador',
    'Send Notification': 'Enviar notificação',
    'Privacy Policy': 'Política de privacidade',
    'Envato Verify Purchase': 'Verificar licença da Envato',
    'View Series Reports': 'Ver denúncias de séries',
    'View Movie Reports': 'Ver denúncias de filmes',
    'View Channel Reports': 'Ver denúncias de canais',
    'Edit Video': 'Editar vídeo',
    'Manage Movies': 'Gerenciar filmes',
    'Manage Channel': 'Gerenciar canais',
    'Manage Category': 'Gerenciar categorias',
    'Manage Genre': 'Gerenciar gêneros',
    'Manage Language': 'Gerenciar idiomas',
    'Manage Season': 'Gerenciar temporadas',
    'Manage TV Series': 'Gerenciar séries',
    'Manage Series': 'Gerenciar séries',
    'Manage Seasons': 'Gerenciar temporadas',
    'Manage Episodes': 'Gerenciar episódios',
    'Manage Channels': 'Gerenciar canais',
    'Manage Categories': 'Gerenciar categorias',
    'Manage Languages': 'Gerenciar idiomas',
    'Manage Genres': 'Gerenciar gêneros',
    'Manage Users': 'Gerenciar usuários',
    'Manage Comments': 'Gerenciar comentários',
    'Manage Reports': 'Gerenciar denúncias',
    'Add Movie': 'Adicionar filme',
    'Add Movies': 'Adicionar filme',
    'Add Series': 'Adicionar série',
    'Add Season': 'Adicionar temporada',
    'Add Episode': 'Adicionar episódio',
    'Add Channel': 'Adicionar canal',
    'Add Category': 'Adicionar categoria',
    'Add Language': 'Adicionar idioma',
    'Add Genre': 'Adicionar gênero',
    'Add User': 'Adicionar usuário',
    'Edit Movie': 'Editar filme',
    'Edit Movies': 'Editar filme',
    'Edit Series': 'Editar série',
    'Edit Season': 'Editar temporada',
    'Edit Episode': 'Editar episódio',
    'Edit Channel': 'Editar canal',
    'Edit Category': 'Editar categoria',
    'Edit Language': 'Editar idioma',
    'Edit Genre': 'Editar gênero',
    'Edit User': 'Editar usuário',
    'Save': 'Salvar',
    'Update': 'Atualizar',
    'Submit': 'Enviar',
    'Send': 'Enviar',
    'Fetch': 'Buscar',
    'Search': 'Pesquisar',
    'Filter': 'Filtrar',
    'Reset': 'Limpar',
    'Cancel': 'Cancelar',
    'Close': 'Fechar',
    'Delete': 'Excluir',
    'Edit': 'Editar',
    'View': 'Visualizar',
    'Remove': 'Remover',
    'Add More': 'Adicionar mais',
    '+ Add More': '+ Adicionar mais',
    'Add More Season': 'Adicionar outra temporada',
    'Select All': 'Selecionar todos',
    'Action': 'Ações',
    'Actions': 'Ações',
    'Status': 'Status',
    'Active': 'Ativo',
    'Inactive': 'Inativo',
    'Enable': 'Ativar',
    'Disable': 'Desativar',
    'Enabled': 'Ativado',
    'Disabled': 'Desativado',
    'Featured': 'Destaque',
    'Slider': 'Banner rotativo',
    'Yes': 'Sim',
    'No': 'Não',
    'True': 'Sim',
    'False': 'Não',
    'ON': 'LIGADO',
    'OFF': 'DESLIGADO',
    'Name': 'Nome',
    'Title': 'Título',
    'Description': 'Descrição',
    'Email': 'E-mail',
    'Phone': 'Telefone',
    'Image': 'Imagem',
    'Poster': 'Pôster',
    'Cover': 'Capa',
    'Type': 'Tipo',
    'URL': 'URL',
    'Current URL': 'URL atual',
    'Views': 'Visualizações',
    'Rating': 'Avaliação',
    'Ratings': 'Avaliações',
    'Total Views': 'Total de visualizações',
    'Total Ratings': 'Total de avaliações',
    'Created On': 'Criado em',
    'Date': 'Data',
    'Message': 'Mensagem',
    'Optional': 'Opcional',
    '(Optional)': '(Opcional)',
    'Required': 'Obrigatório',
    'Select Image': 'Selecionar imagem',
    'Select Category': 'Selecionar categoria',
    'Select Language': 'Selecionar idioma',
    'Select Genre': 'Selecionar gênero',
    'Select Series': 'Selecionar série',
    'Select Season': 'Selecionar temporada',
    'Select Movie': 'Selecionar filme',
    'Select Channel': 'Selecionar canal',
    'Select Type': 'Selecionar tipo',
    '--Select Category--': '--Selecione a categoria--',
    '--Select Language--': '--Selecione o idioma--',
    '--Select Genre--': '--Selecione o gênero--',
    '--Select Series--': '--Selecione a série--',
    '--Select Season--': '--Selecione a temporada--',
    '--Select Movie--': '--Selecione o filme--',
    '--Select Channel--': '--Selecione o canal--',
    '--Select Type--': '--Selecione o tipo--',
    '---Select Type---': '---Selecione o tipo---',
    'Category Name': 'Nome da categoria',
    'Genre Name': 'Nome do gênero',
    'Language Title': 'Nome do idioma',
    'Movie Title': 'Título do filme',
    'Series Name': 'Nome da série',
    'Season name': 'Nome da temporada',
    'Episode Title': 'Título do episódio',
    'Channel Title': 'Nome do canal',
    'Movie Description': 'Descrição do filme',
    'Series Description': 'Descrição da série',
    'Channel Description': 'Descrição do canal',
    'Poster Image': 'Imagem do pôster',
    'Cover Image': 'Imagem de capa',
    'Video Upload Type': 'Tipo de envio do vídeo',
    'Subtitle Upload Type': 'Tipo de envio da legenda',
    'Subtitle Language': 'Idioma da legenda',
    'Subtitle ON/OFF': 'Legendas ligadas/desligadas',
    'Quality ON/OFF': 'Qualidades ligadas/desligadas',
    'Browse Video': 'Selecionar vídeo',
    'Browse Subtitle': 'Selecionar legenda',
    'Enter URL': 'Informe a URL',
    'Local System': 'Arquivo local',
    'Live URL': 'URL de transmissão',
    'Live Url': 'URL de transmissão',
    'Android Type': 'Tipo no Android',
    'Android Channel Url': 'URL do canal no Android',
    'iOS Type': 'Tipo no iOS',
    'iOS Channel Url': 'URL do canal no iOS',
    'User Agent': 'Agente do usuário',
    'User Agent Type': 'Tipo de agente do usuário',
    'User Agent Name': 'Nome do agente do usuário',
    'Get from setting': 'Usar configuração geral',
    'Custom': 'Personalizado',
    'App Name': 'Nome do aplicativo',
    'App Logo': 'Logo do aplicativo',
    'App Description': 'Descrição do aplicativo',
    'App Version': 'Versão do aplicativo',
    'Author': 'Autor',
    'Contact': 'Contato',
    'Website': 'Site',
    'Developed By': 'Desenvolvido por',
    'Publisher ID': 'ID do publicador',
    'Banner Ads': 'Anúncios em banner',
    'Banner Ad Type': 'Tipo de anúncio em banner',
    'Banner ID': 'ID do banner',
    'Interstitial Ads': 'Anúncios intersticiais',
    'Interstitial Ad Type': 'Tipo de anúncio intersticial',
    'Interstitial Ad ID': 'ID do anúncio intersticial',
    'Interstitial Clicks': 'Cliques para exibir anúncio intersticial',
    'Latest Limit': 'Limite de itens recentes',
    'Page Limit': 'Itens por página',
    'Category List Order By': 'Ordenar categorias por',
    'Category Post Order By': 'Ordenar canais da categoria por',
    'Language List Order By': 'Ordenar idiomas por',
    'Genre List Order By': 'Ordenar gêneros por',
    'Channel ID': 'ID do canal',
    'Channel Name': 'Nome do canal',
    'App Privacy Policy URL': 'URL da política de privacidade',
    'App Privacy Policy': 'Política de privacidade',
    'SMTP Type': 'Tipo de SMTP',
    'SMTP Host': 'Servidor SMTP',
    'SMTPSecure': 'Segurança SMTP',
    'Enter Port No.': 'Informe a porta',
    'OneSignal App ID': 'ID do aplicativo OneSignal',
    'OneSignal Rest Key': 'Chave REST do OneSignal',
    'Profile Image': 'Imagem do perfil',
    'Notification for': 'Notificação para',
    'External Link': 'Link externo',
    'Envato Username': 'Usuário da Envato',
    'Envato Purchase Code': 'Código de compra da Envato',
    'Android Package Name': 'Nome do pacote Android',
    'Report Section': 'Detalhes da denúncia',
    'Sorry !': 'Desculpe!',
    'No Item Found': 'Nenhum item encontrado',
    'No Data Found': 'Nenhum dado encontrado',
    'No record found': 'Nenhum registro encontrado',
    'No matching records found': 'Nenhum registro correspondente encontrado',
    'Processing...': 'Processando...',
    'Loading...': 'Carregando...',
    'Show': 'Exibir',
    'entries': 'registros',
    'Previous': 'Anterior',
    'Next': 'Próximo',
    'First': 'Primeiro',
    'Last': 'Último',
    'Are you sure?': 'Tem certeza?',
    'You will not be able to recover this data!': 'Não será possível recuperar estes dados!',
    'Yes, delete it!': 'Sim, excluir!',
    'Something went to wrong !': 'Algo deu errado!',
    'Previous subtitle data must be filled !': 'Preencha os dados da legenda anterior!',
    'Please wait...': 'Aguarde...',
    'Successfully': 'Concluído com sucesso',
    'Error': 'Erro',
    'Note': 'Observação',
    'OR': 'OU',
    'All Rights Reserved.': 'Todos os direitos reservados.'
  };

  var placeholders = {
    'Username': 'Usuário',
    'Password': 'Senha',
    'Enter category name': 'Informe o nome da categoria',
    'Enter genre name': 'Informe o nome do gênero',
    'Enter language title': 'Informe o nome do idioma',
    'Enter common user agent for channels': 'Informe o agente do usuário padrão para os canais',
    'Enter Port No.': 'Informe a porta',
    'Search...': 'Pesquisar...'
  };

  function preserveWhitespace(original, translated) {
    var leading = original.match(/^\s*/)[0];
    var trailing = original.match(/\s*$/)[0];
    return leading + translated + trailing;
  }

  function translateString(value) {
    if (!value) return value;
    var trimmed = value.trim();
    var suffix = '';
    var base = trimmed;

    if (/\s*:-$/.test(base)) {
      base = base.replace(/\s*:-$/, '').trim();
      suffix = ' :';
    } else if (/\s*:$/.test(base)) {
      base = base.replace(/\s*:$/, '').trim();
      suffix = ':';
    }

    var translated = translations[base] || translations[trimmed];
    if (translated) return preserveWhitespace(value, translated + (translations[trimmed] ? '' : suffix));

    if (/ Ratings$/.test(trimmed)) {
      return preserveWhitespace(value, trimmed.replace(/ Ratings$/, ' — Avaliações'));
    }
    var showing = trimmed.match(/^Showing (\d+) to (\d+) of (\d+) entries$/);
    if (showing) {
      return preserveWhitespace(value, 'Exibindo ' + showing[1] + ' a ' + showing[2] + ' de ' + showing[3] + ' registros');
    }

    return value;
  }

  function translateElement(element) {
    if (!element || element.nodeType !== 1) return;

    var textNodes = [];
    for (var i = 0; i < element.childNodes.length; i++) {
      if (element.childNodes[i].nodeType === 3) textNodes.push(element.childNodes[i]);
    }
    textNodes.forEach(function (node) {
      var translated = translateString(node.nodeValue);
      if (translated !== node.nodeValue) node.nodeValue = translated;
    });

    ['placeholder', 'title', 'aria-label'].forEach(function (attribute) {
      if (!element.hasAttribute(attribute)) return;
      var current = element.getAttribute(attribute);
      var translated = placeholders[current] || translateString(current);
      if (translated !== current) element.setAttribute(attribute, translated);
    });

    if ((element.type === 'submit' || element.type === 'button') && element.value) {
      var translatedValue = translateString(element.value);
      if (translatedValue !== element.value) element.value = translatedValue;
    }
  }

  var selectors = [
    'label', 'button', 'th', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
    '.title', '.page_title', '.card-title', '.panel-title', '.control-label-help', '.not_data',
    '.field_lable', '.help-text', '.nav-tabs a',
    '.alert', '.notifyjs-wrapper', '.sweet-alert p', '.sweet-alert h2',
    '.breadcrumb', '.pagination a', '.btn', '.dataTables_info',
    '.dataTables_filter label', '.dataTables_length label', 'option',
    'input[type="submit"]', 'input[type="button"]', 'input[placeholder]',
    'textarea[placeholder]', '[title]', '[aria-label]'
  ].join(',');

  function translateRoot(root) {
    if (!root) return;
    if (root.matches && root.matches(selectors)) translateElement(root);
    if (root.querySelectorAll) {
      var elements = root.querySelectorAll(selectors);
      for (var i = 0; i < elements.length; i++) translateElement(elements[i]);
    }
  }

  function translateDocumentTitle() {
    var parts = document.title.split('|');
    document.title = parts.map(function (part) {
      return translateString(part).trim();
    }).join(' | ');
  }

  var originalAlert = window.alert;
  window.alert = function (message) {
    return originalAlert.call(window, translateString(String(message)));
  };

  document.documentElement.lang = 'pt-BR';
  translateDocumentTitle();
  translateRoot(document);

  var observer = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
      for (var i = 0; i < mutation.addedNodes.length; i++) {
        translateRoot(mutation.addedNodes[i]);
      }
    });
  });
  observer.observe(document.body, { childList: true, subtree: true });
})();
