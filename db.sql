use Ecommerce
/*
create table Usuarios(
	Id int primary key identity,
	Usuario varchar(255) unique,
	Senha varchar(255),
	DataCadastro datetime,
)
go
*/
create table UF(
	Id int primary key identity,
	Sigla char(2) unique,
	Descricao varchar(255) unique
)
go
create table Cidade(
	Id int primary key identity,
	Cidade varchar(255),
	UfId int references UF(Id)
)
go
create table Clientes(
	Id int primary key identity,
	Nome varchar(255),
	CPF varchar(255) unique,
	CidadeId int references Cidade(Id),
	UsuarioId int references Users(Id),
	CEP varchar(255) unique,
	Endereco varchar(255)
)
go
create table Produtos(
	Id int primary key identity,
	Descricao varchar(255),
	PrecoCusto decimal(10, 2),
	PrecoVenda decimal(10, 2),
	Peso decimal(10, 3),
	ProdutoStatus bit
)
go
create table Estoque(
	Id int primary key identity,
	ProdutoId int references Produtos(Id),
	Qtde int,
	Validade datetime null,
	Lote int null,
	--constraint PkEstoque primary key(ProdutoId, Lote)
)
go


create table PedidoStatus(
	Id int primary key identity,
	Descricao varchar(255) not null
)

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

--insert Users values ('Administrador', '002163', getdate())
insert UF	     values ('SP', 'São Paulo'), ('RJ', 'Rio de Janeiro'), ('GO', 'Goias')
insert Cidade   values ('Santo André', 1), ('Campinas', 1), ('São Paulo', 1)
insert Clientes values ('Ana Maria', '63613695652', 1, 1, '08390060', 'Av Braz Leme')
insert Produtos values ('Produto01', 10.20, 15.00, 1.350, 1), ('Produto02', 8.20, 10.50, 1.000, 1), ('Produto03', 5.00, 7.00, 0.500, 1)
insert PedidoStatus values('Aberto'), ('Finalizado'), ('Cancelado')
--insert EstoqueEntrada values ('1', getdate(), )

--insert PedidoVendas values (1, 0, 0, 0, 0, 0, getdate())
--insert PedidoVendaItens values (1, 1, 2, 15.00, 10.20, 0, 0), (1, 2, 5, 11.00, 8.00, 0, 0)

update a set a.Peso = (select b.peso * a.qtde from Produtos b where a.ProdutoId = b.Id) from PedidoVendaItens a

update a set
	a.ValorTotal = (select sum(ValorTotal) from PedidoVendaItens b where b.PedidoId = a.Id),
	a.CustoTotal = (select sum(ValorCusto * Qtde) from PedidoVendaItens b where b.PedidoId = a.Id),
	a.QtdeItens = (select count(ProdutoId) from PedidoVendaItens b where b.PedidoId = a.Id),
	a.PesoTotal = (select sum(peso) from PedidoVendaItens b where b.PedidoId = a.Id)
	from PedidoVendas a

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
	declare @pedido int

	select @valorInserted = ValorTotal, @custoInserted = ValorCusto, @pedido = PedidoId from Inserted

	update PedidoVendas set ValorTotal += @valorInserted, CustoTotal += @custoInserted where Id = @pedido
end

go

create trigger TRemoveItemPedidoFD
On PedidoVendaItens
for delete
as
begin
	declare @valorDeleted decimal(10,2)
	declare @custoDeleted decimal(10, 2)
	declare @pedido int

	select @valorDeleted = ValorTotal, @custoDeleted = ValorCusto, @pedido = PedidoId from deleted

	update PedidoVendas set ValorTotal -= @valorDeleted, CustoTotal -= @custoDeleted where Id = @pedido
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
--drop table Usuarios

*/