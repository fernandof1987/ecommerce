use Ecommerce

create table password_resets(
	email nvarchar(255) NOT NULL,
	token nvarchar(255) NOT NULL,
	created_at datetime NULL
)
go
create table TipoUsuario(
	Id int identity primary key,
	Nome varchar(255)
)
go
	insert TipoUsuario values('Admin'), ('Cliente')
go
create table users(
	id int primary key identity,
	name nvarchar(255) not null,
	email nvarchar(255) not null unique,
	password nvarchar(255) not null,
	remember_token nvarchar(100) null,
	created_at datetime null,
	updated_at datetime null,
	TipoUsuarioId int default 2 references TipoUsuario(Id)
)
go
	insert Users values
		('Administrador', 'admin@admin.com', '$2y$10$wGUN65fcK6fg74.VLKJp/uPtRA5hwgcXCI7V4uN6cN7n3rXJpjcBy', null, null, null, 1),
		('Fernando', 'fernandof1987@gmail.com', '$2y$10$wGUN65fcK6fg74.VLKJp/uPtRA5hwgcXCI7V4uN6cN7n3rXJpjcBy', null, null, null, 2)
go
create table UF(
	Id int primary key identity,
	Sigla char(2) unique,
	Descricao varchar(255) unique
)
go
	insert UF values ('SP', 'São Paulo'), ('RJ', 'Rio de Janeiro'), ('GO', 'Goias')
go
create table Cidade(
	Id int primary key identity,
	Cidade varchar(255),
	UfId int references UF(Id)
)
go
	insert Cidade   values ('Santo André', 1), ('Campinas', 1), ('São Paulo', 1)
go
create table Clientes(
	Id int primary key identity,
	UserId int references users(Id),
	Nome varchar(255),
	CPF varchar(255) unique,
	CidadeId int references Cidade(Id),
	CEP varchar(255) unique,
	Endereco varchar(255)
)
go
	insert Clientes values (2, 'Fernando F. da Silva', '36139686813', 1, '05983728', 'Rua teste testando, 113')
go
create table Marcas(
	Id int primary key identity,
	Nome varchar(255) not null
)
go
	insert Marcas values ('Marca1'), ('Marca2')
go
create table Categorias(
	Id int primary key identity,
	Nome varchar(255) not null
)
go
	insert Categorias values('Importados'), ('Nacionais')
go
create table Produtos(
	Id int primary key identity,
	MarcaId int references Marcas(Id), 
	CategoriaId int references Categorias(Id),
	Nome varchar(255) not null,
	Descricao varchar(255),
	PrecoCusto decimal(10, 2),
	PrecoVenda decimal(10, 2),
	Peso decimal(10, 3),
	ProdutoStatus bit,
	Imagem varchar(255) null
)
go
	insert Produtos values
		(1, 1, 'Produto-01', 'Produto..........', 2.00, 3.00, 0.900, 1, null),
		(2, 2, 'Produto-02', 'Produto..........', 1.00, 3.50, 0.600, 1, null),
		(2, 1, 'Produto-03', 'Produto..........', 1.50, 2.50, 0.500, 1, null),
		(1, 2, 'Produto-04', 'Produto..........', 1.60, 1.90, 0.700, 1, null),
		(1, 1, 'Produto-05', 'Produto..........', 2.00, 3.00, 0.900, 1, null),
		(2, 2, 'Produto-06', 'Produto..........', 1.00, 3.50, 0.600, 1, null),
		(2, 1, 'Produto-07', 'Produto..........', 1.50, 2.50, 0.500, 1, null),
		(1, 2, 'Produto-08', 'Produto..........', 1.60, 1.90, 0.700, 1, null),
		(1, 2, 'Produto-09', 'Produto..........', 1.60, 1.90, 0.700, 1, null)
go
create table Estoque(
	Id int primary key identity,
	ProdutoId int references Produtos(Id),
	Qtde int,
	Validade datetime null,
	Lote int null
	--constraint PkEstoque primary key(ProdutoId, Lote)
)
go


create table PedidoStatus(
	Id int primary key identity,
	Descricao varchar(255) not null
)
go
	insert PedidoStatus values('Aberto'), ('Finalizado'), ('Cancelado')
go
create table PedidoVendas(
	Id int primary key identity,
	UsuarioId int references Users(Id),
	QtdeItens int default 0 not null,
	ValorTotal decimal(10, 2) default 0 not null,
	CustoTotal decimal(10, 2) default 0 not null,
	PesoTotal decimal(10, 3) default 0 not null,
	Desconto decimal(10, 2) default 0 not null,
	DataPedido datetime default getdate() not null,
	PedidoStatus int references PedidoStatus(Id) default 1 not null
)
go
create table EstoqueSaida(
	Id int primary key identity,
	EstoqueId int references Estoque(Id),
	DataSaida datetime default getdate(),
	QtdeAnterior int,
	QtdeSaida int,
	QtdeRestante int,
	UsuarioId int references Users(Id),
	PedidoVendaId int null,
	Obs varchar(255)
)
go
create table EstoqueEntrada(
	Id int primary key identity,
	--EstoqueId int references Estoque(Id),
	ProdutoId int references Produtos(Id),
	DataEntrada datetime default getdate(),
	QtdeAnterior int,
	QtdeEntrada int,
	QtdeRestante int,
	UsuarioId int references Users(Id),
	PedidoCompraId int null,
	Obs varchar(255)
)
go
create table PedidoVendaItens(
	Id int primary key identity,
	PedidoId int references PedidoVendas(Id),
	ProdutoId int references Produtos(Id),
	Qtde int default 0 not null,
	ValorVenda decimal(10, 2) default 0 not null,
	ValorCusto decimal(10, 2) default 0 not null,
	Desconto decimal(10, 2) default 0 not null,
	ValorTotal as (Qtde * (ValorVenda - Desconto)),
	Peso decimal(10, 3)
)

--insert Users values ('Administrador', 'admin@admin.com', '123456', null, null, null)
--insert Clientes values ('Ana Maria', '63613695652', 1, 1, '08390060', 'Av Braz Leme')
--insert Produtos values ('Produto01', 1, 10.20, 15.00, 1.350, 1), ('Produto02', 1, 8.20, 10.50, 1.000, 1), ('Produto03', 2, 5.00, 7.00, 0.500, 1)

--insert EstoqueEntrada values ('1', getdate(), )

--insert PedidoVendas values (1, 0, 0, 0, 0, 0, getdate())
--insert PedidoVendaItens values (1, 1, 2, 15.00, 10.20, 0, 0), (1, 2, 5, 11.00, 8.00, 0, 0)

/*
update a set a.Peso = (select b.peso * a.qtde from Produtos b where a.ProdutoId = b.Id) from PedidoVendaItens a

update a set
	a.ValorTotal = (select sum(ValorTotal) from PedidoVendaItens b where b.PedidoId = a.Id),
	a.CustoTotal = (select sum(ValorCusto * Qtde) from PedidoVendaItens b where b.PedidoId = a.Id),
	a.QtdeItens = (select count(ProdutoId) from PedidoVendaItens b where b.PedidoId = a.Id),
	a.PesoTotal = (select sum(peso) from PedidoVendaItens b where b.PedidoId = a.Id)
	from PedidoVendas a
*/

select * from Users
select * from UF
select * from Cidade
select * from Clientes
select * from Produtos
select * from PedidoVendas
select * from PedidoVendaItens
select * from Estoque
select * from EstoqueSaida
select * from EstoqueEntrada

go


create trigger TSomaItemPedidoAI
On PedidoVendaItens
after insert
as
begin
	declare @valorInserted decimal(10,2)
	declare @custoInserted decimal(10, 2)
	declare @peso decimal(10, 2)
	declare @qtde int
	declare @pedido int

	select @valorInserted = ValorTotal, @custoInserted = ValorCusto, @pedido = PedidoId, @peso = Peso, @qtde = Qtde from Inserted

	update PedidoVendas set ValorTotal += @valorInserted, CustoTotal += @custoInserted, QtdeItens += 1, PesoTotal += (@peso * @qtde) where Id = @pedido
end

go

create trigger TRemoveItemPedidoFD
On PedidoVendaItens
for delete
as
begin
	declare @valorDeleted decimal(10,2)
	declare @custoDeleted decimal(10, 2)
	declare @peso decimal(10, 2)
	declare @qtde int
	declare @pedido int

	select @valorDeleted = ValorTotal, @custoDeleted = ValorCusto, @pedido = PedidoId, @peso = Peso, @qtde = Qtde from deleted

	update PedidoVendas set ValorTotal -= @valorDeleted, CustoTotal -= @custoDeleted, QtdeItens -= 1, PesoTotal -= (@peso * @qtde) where Id = @pedido
end

go

create trigger TCalculaItemPedidoFU
On PedidoVendaItens
for update
as
begin
	declare @valorInserted decimal(10,2)
	declare @valorDeleted decimal(10, 2)
	declare @custoInserted decimal(10, 2)
	declare @custoDeleted decimal(10, 2)
	declare @pedido int


	select @valorInserted = ValorTotal, @custoInserted = ValorCusto, @pedido = PedidoId from inserted
	select @valorDeleted = ValorTotal, @custoDeleted = ValorCusto from deleted

	update PedidoVendas set ValorTotal -= @valorDeleted, CustoTotal -= @custoDeleted where Id = @pedido
	update PedidoVendas set ValorTotal += @valorInserted, CustoTotal += @custoInserted where Id = @pedido

	
end



--phelp PedidoVendaItens


/*
drop table PedidoVendaItens
go
drop table PedidoVendas
go 
drop table PedidoStatus
go
drop table Clientes
go
drop table Cidade
go
drop table UF
go
drop table EstoqueSaida
go
drop table EstoqueEntrada
go
drop table Estoque
go
drop table Produtos
go
drop table Marcas
go
drop table Categorias
go
drop table Users
go
drop table TipoUsuario
go
drop table password_resets

*/
