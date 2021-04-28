-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Serveur: votre.informaticien.sql.free.fr (bac à sable)
-- Généré le : Lun 26 Avril 2021 à 17:10
-- Version du serveur: 5.0.83
-- Version de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `votre_informaticien`
--

-- --------------------------------------------------------

--
-- Structure de la table `STTABREMPL`
--

CREATE TABLE IF NOT EXISTS `STTABREMPL` (
  `STSALLE` varchar(20) collate latin1_general_ci NOT NULL,
  `STSEANCE` varchar(20) collate latin1_general_ci NOT NULL,
  `STMOVIE` varchar(20) collate latin1_general_ci NOT NULL,
  `STREMPL` varchar(255) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `STTABREMPL`
--
