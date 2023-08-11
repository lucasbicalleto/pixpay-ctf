CREATE DATABASE IF NOT EXISTS pixpay;
USE pixpay;

-- Estrutura da tabela `contas`
CREATE TABLE `contas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `saldo` varchar(255) DEFAULT NULL,
  `chave_pix` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `admin` tinyint(4) DEFAULT 0,
  `ativo` tinyint(4) DEFAULT 1,
  `data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir dados na tabela `contas`
INSERT INTO `contas` (`id`, `nome`, `email`, `cpf`, `senha`, `saldo`, `chave_pix`, `foto`, `admin`, `ativo`, `data_cadastro`)
VALUES
(1, 'Ian Davi Rodrigues', 'ian.davi.rodrigues@ativa.inf.br', '268.960.149-46', 'GxFmUHDzco', '1.000,00', '(95) 99795-7590', NULL, 0, 1, '2023-06-20 19:57:50'),
(2, 'Pietra Betina Viana', 'pietrabetinaviana@coldblock.com.br', '727.363.790-47', 'r89QaZU8TR', '720,32', 'pietrabetinaviana@coldblock.com.br', NULL, 0, 1, '2023-06-20 20:03:05'),
(3, 'Sandra Malu Barros', 'sandra_malu_barros@fabiooliva.com.br', '343.895.189-41', 'EYRtsYJ5RG', '1,80', 'sandra_malu_barros@fabiooliva.com.br', NULL, 0, 1, '2023-06-20 20:04:14'),
(4, 'Benício Ruan da Rocha', 'benicio.ruan.darocha@escribacontabil.com.br', '253.265.129-63', 'lQrYK99O4D', '0,00', NULL, NULL, 0, 1, '2023-06-20 20:04:36'),
(5, 'Raquel Manuela da Mata', 'raquel_manuela_damata@julietavinhas.fot.br', '906.418.024-55', '123456', '75,90', 'raquel_manuela_damata@julietavinhas.fot.br', NULL, 0, 1, '2023-06-20 20:07:16'),
(6, 'Yago Cauê Pereira', '786.396.862-38', '786.396.862-38', 'jJ7nwuj6BT', '9.415,75', 'yago.caue.pereira@cincoentretenimentos.com.br', NULL, 0, 1, '2023-06-22 18:58:25');

-- Estrutura da tabela `convidado`
CREATE TABLE `convidado` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL DEFAULT 'convidado',
  `email` varchar(255) NOT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir dados na tabela `convidado`
INSERT INTO `convidado` (`id`, `nome`, `email`, `ativo`)
VALUES
(1, 'Convdado', 'i\'m.invited@pixpay.com', 1);

-- Estrutura da tabela `transacoes`
CREATE TABLE `transacoes` (
  `id` int(11) NOT NULL,
  `usuario_origem` varchar(255) NOT NULL,
  `usuario_destino` varchar(255) NOT NULL,
  `chave_pix` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `valor` varchar(255) NOT NULL,
  `data` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
