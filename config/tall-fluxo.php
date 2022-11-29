<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

use Tall\Fluxo\Core\Fields\Field;
use Illuminate\Validation\Rule;

return [
    'fildes'=>[
        'before'=>[
            Field::make(null,
            'nome_produto',
            'nome_produto',
            'text',
            null,
            8,
            1,
            'defer',
            null,
            'published')
            ->fluxo_field_validation([
                'required'=>null
            ])
            ->form_attributes([
                'wire:model.defer'=>'data.nome_produto',
                'type'=>'text',
                'class'=>'block w-full rounded-md border-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'
            ])->label('Nome do Produto')->sortable(true)->listado(true),
            Field::make(null,
            'cod_barras',
            'cod_barras',
            'text',
            null,
            4,
            1,
            'defer',
            null,
            'published')
            ->fluxo_field_validation([
                'required'=>null,
                'unique'=>'fluxo_etapa_produtos,cod_barras'
            ])->form_attributes([
                'wire:model.defer'=>'data.cod_barras',
                'type'=>'text',
                'class'=>'block w-full rounded-md border-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm'
            ])->label('Código de Barra')->sortable(true)->listado(true)
        ],
        'after'=>[

        ]
    ],
    'views'=>[
        'form'=>[
            'text',
            'radio',
            'checkbox',
            'select',
            'date',
            'datetime-local',
            'range',
            'number',
            'textarea',
            'moeda',
            'centimetros',
            'peso',

        ],
        'db'=>[
            'db',
            'db-radio',
            'db-checkbox',
            'db-select',
            'db-range',
            'db-number',
        ],
        'table'=>[
            'db',
            'text',
            'cover',
            'status',
            'avatar',
            'email',
            'phone',
            'date',
            'datetime-local',
            'range',
            'money',
            'detail'
            ]
        ],
        'validations'=>[
            "accepted"=>["label"=>"Accepted","params"=>false,"visible"=>true, "help"=>"O campo em validação deve ser <b>yes, on, 1 ou true</b>. Isso é útil para validar a aceitação dos Termos de Serviço ou campos semelhantes."],
            "accepted_if"=>["label"=>"Accepted If","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser <b>yes, on, 1 ou true</b> se outro campo em validação for igual a um valor especificado. Isso é útil para validar a aceitação dos <b>Termos de Serviço</b> ou campos semelhantes."],
            "active_url"=>["label"=>"Active URL","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ter um registro A ou AAAA válido de acordo com a dns_get_recordfunção PHP. O nome do host da URL fornecida é extraído usando a parse_urlfunção PHP antes de ser passado para dns_get_record."],
            "after"=>["label"=>"After (Date)","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser um valor após uma determinada data. As datas serão passadas para a strtotimefunção PHP para serem convertidas em uma DateTimeinstância válida:"],
            "after_or_equal"=>["label"=>"After Or Equal (Date)","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser um valor posterior ou igual à data indicada. Para obter mais informações, consulte a regra após ."],
            "alpha"=>["label"=>"Alpha","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser inteiramente de caracteres alfabéticos."],
            "alpha_dash"=>["label"=>"Alpha Dash","params"=>true,"visible"=>false, "help"=>"O campo em validação pode conter caracteres alfanuméricos, bem como hífens e sublinhados."],
            "alpha_num"=>["label"=>"Alpha Numeric","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser inteiramente de caracteres alfanuméricos."],
            "array"=>["label"=>"Array","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser um PHP array."],
            "bail"=>["label"=>"Bail","params"=>true,"visible"=>false, "help"=>"Pare de executar regras de validação para o campo após a primeira falha de validação."],
            "before"=>["label"=>"Before (Date)","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser um valor anterior à data especificada. "],
            "before_or_equal"=>["label"=>"Before Or Equal (Date)","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser um valor anterior ou igual à data indicada"],
            "between"=>["label"=>"Between","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ter um tamanho entre o mínimo e o máximo informados (inclusive). Strings, numéricos, arrays e arquivos são avaliados da mesma forma que a sizeregra."],
            "boolean"=>["label"=>"Boolean","params"=>true,"visible"=>true, "help"=>"O campo em validação deve poder ser convertido em booleano. As entradas aceitas são true, false, 1, 0,"],
            "confirmed"=>["label"=>"Confirmed","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ter um campo correspondente de {field}_confirmation."],
            "current_password"=>["label"=>"Current Password","params"=>true,"visible"=>true, "help"=>"O campo em validação deve corresponder à senha do usuário autenticado."],
            "date"=>["label"=>"Date","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser uma data válida e não relativa de acordo com a strtotimefunção PHP"],
            "date_equals"=>["label"=>"Date Equals","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser igual à data indicada. As datas serão passadas para a strtotimefunção PHP para serem convertidas em uma DateTimeinstância válida."],
            "date_format"=>["label"=>"Date Format","params"=>true,"visible"=>true, "help"=>"O campo em validação deve corresponder ao formato fornecido ."],
            "declined"=>["label"=>"Declined","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser no, off, 0 ou false."],
            "declined_if"=>["label"=>"Declined If","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser no, off, 0ou falsese outro campo em validação for igual a um valor especificado."],
            "different"=>["label"=>"Different","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ter um valor diferente do campo ."],
            "digits"=>["label"=>"Digits","params"=>true,"visible"=>true, "help"=>"O inteiro em validação deve ter um comprimento exato de value ."],
            "digits_between"=>["label"=>"Digits Between","params"=>true,"visible"=>true, "help"=>"A validação de número inteiro deve ter um comprimento entre o mínimo e o máximo especificados ."],
            "dimensions"=>["label"=>"Dimensions (Image Files)","params"=>true,"visible"=>true, "help"=>"O arquivo em validação deve ser uma imagem que atenda às restrições de dimensão especificadas pelos parâmetros da regra:As restrições disponíveis são: min_width , max_width , min_height , max_height , width , height , ratio ."],
            "distinct"=>["label"=>"Distinct","params"=>true,"visible"=>true, "help"=>"Ao validar arrays, o campo em validação não deve ter valores duplicados:"],
            "doesnt_start_with"=>["label"=>"Doesnt Start With","params"=>true,"visible"=>true, "help"=>"O campo em validação não deve iniciar com um dos valores informados."],
            "doesnt_end_with"=>["label"=>"Doesnt End With","params"=>true,"visible"=>true, "help"=>"O campo em validação não deve terminar com um dos valores informados."],
            "email"=>["label"=>"Email","params"=>false,"visible"=>true, "help"=>"O campo em validação deve ser formatado como um endereço de e-_mail."],
            "ends_with"=>["label"=>"Ends With","params"=>true,"visible"=>true, "help"=>"O campo em validação deve terminar com um dos valores indicados."],
            "enum"=>["label"=>"Enum","params"=>true,"visible"=>true, "help"=>"A Enumregra é uma regra baseada em classe que valida se o campo em validação contém um valor de enumeração válido. A Enumregra aceita o nome do enum como seu único argumento de construtor:"],
            "exclude"=>["label"=>"Exclude","params"=>true,"visible"=>true, "help"=>"O campo em validação será excluído dos dados da requisição retornados pelos métodos validatee .validated"],
            "exclude_if"=>["label"=>"Exclude If","params"=>true,"visible"=>true, "help"=>"O campo em validação será excluído dos dados da requisição retornados pelos métodos validatee se o campo otherfield for igual a value .validated"],
            "exclude_unless"=>["label"=>"Exclude Unless","params"=>true,"visible"=>true, "help"=>"O campo em validação será excluído dos dados da requisição retornados pelos métodos validatee a menos que o campo de outro campo seja igual a value ."],
            "exclude_with"=>["label"=>"Exclude With","params"=>true,"visible"=>true, "help"=>"O campo em validação será excluído dos dados da requisição retornados pelos métodos validatee se o campo otherfield estiver presente.validated"],
            "exclude_without"=>["label"=>"Exclude Without","params"=>true,"visible"=>true, "help"=>"O campo em validação será excluído dos dados da requisição retornados pelos métodos validatee se o campo otherfield não estiver presente.validated"],
            "exists"=>["label"=>"Exists (Database)","params"=>true,"visible"=>true, "help"=>"O campo em validação deve existir em uma determinada tabela do banco de dados."],
            "file"=>["label"=>"File","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser um arquivo carregado com sucesso."],
            "filled"=>["label"=>"Filled","params"=>true,"visible"=>false, "help"=>"O campo em validação não deve estar vazio quando presente."],
            "gt"=>["label"=>"Greater Than","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser maior que o campo informado . Os dois campos devem ser do mesmo tipo. Strings, numéricos, arrays e arquivos são avaliados usando as mesmas convenções da sizeregra."],
            "gte"=>["label"=>"Greater Than Or Equal","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser maior ou igual ao campo informado . Os dois campos devem ser do mesmo tipo. Strings, numéricos, arrays e arquivos são avaliados usando as mesmas convenções da sizeregra."],
            "image"=>["label"=>"Image (File)","params"=>true,"visible"=>true, "help"=>"O arquivo em validação deve ser uma imagem (jpg, jpeg, png, bmp, gif, svg ou webp)."],
            "in"=>["label"=>"In","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser incluído na lista de valores fornecida. Como essa regra geralmente exige que você implodecrie um array, o Rule::inmétodo pode ser usado para construir a regra com fluência:"],
            "in_array"=>["label"=>"In Array","params"=>true,"visible"=>true, "help"=>"O campo em validação deve existir nos valores de outro campo."],
            "integer"=>["label"=>"Integer","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser um número inteiro."],
            "ip"=>["label"=>"IP Address","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser um endereço IP."],
            "json"=>["label"=>"JSON","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser uma string JSON válida."],
            "lt"=>["label"=>"Less Than","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser menor que o campo informado . Os dois campos devem ser do mesmo tipo. Strings, numéricos, arrays e arquivos são avaliados usando as mesmas convenções da sizeregra."],
            "lte"=>["label"=>"Less Than Or Equal","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser menor ou igual ao campo informado . Os dois campos devem ser do mesmo tipo. Strings, numéricos, arrays e arquivos são avaliados usando as mesmas convenções da sizeregra."],
            "lowercase"=>["label"=>"Lowercase","params"=>true,"visible"=>true, "help"=>"O campo em validação deve estar em letras minúsculas."],
            "mac"=>["label"=>"MAC Address","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser um endereço MAC."],
            "max"=>["label"=>"Max","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser menor ou igual a um valor máximo . Strings, numéricos, arrays e arquivos são avaliados da mesma forma que a sizeregra."],
            "max_digits"=>["label"=>"Max Digits","params"=>true,"visible"=>true, "help"=>"O inteiro em validação deve ter um comprimento máximo de valor ."],
            "mimetypes"=>["label"=>"MIME Types","params"=>true,"visible"=>true, "help"=>"O arquivo em validação deve corresponder a um dos tipos MIME fornecidos:"],
            "mimes"=>["label"=>"MIME Type By File Extension","params"=>true,"visible"=>true, "help"=>"O arquivo em validação deve ter um tipo MIME correspondente a uma das extensões listadas."],
            "min"=>["label"=>"Min","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ter um valor mínimo . Strings, numéricos, arrays e arquivos são avaliados da mesma forma que a sizeregra."],
            "min_digits"=>["label"=>"Min Digits","params"=>true,"visible"=>true, "help"=>"O inteiro em validação deve ter um comprimento mínimo de valor ."],
            "multiple_of"=>["label"=>"Multiple Of","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser um múltiplo de value ."],
            "not_in"=>["label"=>"Not In","params"=>true,"visible"=>true, "help"=>"O campo em validação não deve ser incluído na lista de valores fornecida."],
            "not_regex"=>["label"=>"Not Regex","params"=>true,"visible"=>true, "help"=>"O campo em validação não deve corresponder à expressão regular fornecida."],
            "nullable"=>["label"=>"Nullable","params"=>false,"visible"=>false, "help"=>"O campo em validação pode ser null."],
            "numeric"=>["label"=>"Numeric","params"=>false,"visible"=>false, "help"=>"O campo em validação deve ser numérico ."],
            "password"=>["label"=>"Password","params"=>false,"visible"=>false, "help"=>"O campo em validação deve corresponder à senha do usuário autenticado."],
            "present"=>["label"=>"Present","params"=>true,"visible"=>false, "help"=>"O campo em validação deve estar presente nos dados de entrada, mas pode estar vazio."],
            "prohibited"=>["label"=>"Prohibited","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser uma string vazia ou ausente."],
            "prohibited_if"=>["label"=>"Prohibited If","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser uma string vazia ou ausente se o campo otherfield for igual a qualquer valor ."],
            "prohibited_unless"=>["label"=>"Prohibited Unless","params"=>true,"visible"=>false, "help"=>"O campo em validação deve ser uma string vazia ou não estar presente, a menos que o campo otherfield seja igual a qualquer valor ."],
            "prohibits"=>["label"=>"Prohibits","params"=>true,"visible"=>false, "help"=>"Se o campo em validação estiver presente, nenhum campo de outro campo poderá estar presente, mesmo que esteja vazio."],
            "regex"=>["label"=>"Regular Expression","params"=>true,"visible"=>true, "help"=>"O campo em validação deve corresponder à expressão regular fornecida."],
            "required"=>["label"=>"Required","params"=>false,"visible"=>true, "help"=>"O campo em validação deve estar presente nos dados de entrada e não vazio. O valor é null, O valor é uma string vazia, O valor é uma matriz vazia ou um Countableobjeto vazio ou O valor é um arquivo carregado sem caminho."],
            "required_if"=>["label"=>"Required If","params"=>true,"visible"=>true, "help"=>"O campo em validação deve estar presente e não vazio se o campo otherfield for igual a algum valor ."],
            "required_unless"=>["label"=>"Required Unless","params"=>true,"visible"=>true, "help"=>"O campo em validação deve estar presente e não vazio, a menos que o campo otherfield seja igual a algum valor ."],
            "required_with"=>["label"=>"Required With","params"=>true,"visible"=>true, "help"=>"O campo em validação deve estar presente e não vazio somente se algum dos outros campos especificados estiver presente e não vazio."],
            "required_with_all"=>["label"=>"Required With All","params"=>true,"visible"=>true, "help"=>"O campo em validação deve estar presente e não vazio somente se todos os outros campos especificados estiverem presentes e não vazios."],
            "required_without"=>["label"=>"Required Without","params"=>true,"visible"=>true, "help"=>"O campo em validação deve estar presente e não vazio somente quando algum dos outros campos especificados estiver vazio ou ausente."],
            "required_without_all"=>["label"=>"Required Without All","params"=>true,"visible"=>true, "help"=>"O campo em validação deve estar presente e não vazio somente quando todos os outros campos especificados estiverem vazios ou ausentes."],
            "required_array_keys"=>["label"=>"Required Array Keys","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser um array e deve conter pelo menos as chaves especificadas."],
            "same"=>["label"=>"Same","params"=>true,"visible"=>true, "help"=>"O campo fornecido deve corresponder ao campo em validação."],
            "size"=>["label"=>"Size","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ter um tamanho compatível com o valor informado ."],
            "starts_with"=>["label"=>"Starts With","params"=>true,"visible"=>true, "help"=>"O campo em validação deve iniciar com um dos valores informados."],
            "string"=>["label"=>"String","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser uma string. Se quiser permitir que o campo também seja null, você deve atribuir a nullableregra ao campo."],
            "timezone"=>["label"=>"Timezone","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser um identificador de fuso horário válido de acordo com a timezone_identifiers_listfunção PHP."],
            "unique"=>["label"=>"Unique (Database)","params"=>true,"visible"=>true, "help"=>"O campo em validação não deve existir na tabela do banco de dados fornecida."],
            "uppercase"=>["label"=>"Uppercase","params"=>true,"visible"=>true, "help"=>"O campo em validação deve estar em letras maiúsculas."],
            "url"=>["label"=>"URL","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser uma URL válida."],
            "uuid"=>["label"=>"UUID","params"=>true,"visible"=>true, "help"=>"O campo em validação deve ser um identificador universalmente exclusivo (UUID)"],
        ]
];
