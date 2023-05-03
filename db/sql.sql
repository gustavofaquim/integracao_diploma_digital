USE [Integracao_Diploma_Abaris]
GO

/****** Object:  Table [dbo].[integracao]    Script Date: 24/04/2023 11:48:49 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[integracao](
	[idintegracao] [int] IDENTITY(1,1) NOT NULL,
	[sigla_instituicao] [varchar](60) NOT NULL,
	[cpf] [char](11) NOT NULL,
	[matricula] [varchar](45) NULL,
	[nome_aluno] [varchar](60) NOT NULL,
	[tentar_novamente] [char](1) NOT NULL,
	[data] [datetime] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[idintegracao] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]




CREATE TABLE [dbo].[retorno_lyceum](
	[idretorno] [int] IDENTITY(1,1) NOT NULL,
	[idintegracao] [int] NOT NULL,
	[msg] [varchar](2000) NULL,
PRIMARY KEY CLUSTERED 
(
	[idretorno] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[retorno_lyceum]  WITH CHECK ADD FOREIGN KEY([idintegracao])
REFERENCES [dbo].[integracao] ([idintegracao])




GO

--SELECT * FROM integracao

--SELECT * FROM retorno_lyceum

