-- Database siap jalan untuk Sistem Cuti Karyawan
-- Import file ini ke phpMyAdmin / MySQL.

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `dbcuti` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbcuti`;

DROP TABLE IF EXISTS `approvecuti`;
DROP TABLE IF EXISTS `pengajuancuti`;
DROP TABLE IF EXISTS `jeniscuti`;
DROP TABLE IF EXISTS `karyawan`;
DROP TABLE IF EXISTS `userlogin`;

CREATE TABLE IF NOT EXISTS `approvecuti` (
  `idapprovecuti` varchar(10) NOT NULL,
  `idpengajuancuti` varchar(10) NOT NULL,
  `tanggalapprove` date NOT NULL,
  `approveby` varchar(50) NOT NULL,
  PRIMARY KEY (`idapprovecuti`),
  KEY `idpengajuancuti` (`idpengajuancuti`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `jeniscuti` (
  `idcuti` varchar(5) NOT NULL,
  `jeniscuti` varchar(50) NOT NULL,
  PRIMARY KEY (`idcuti`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `jeniscuti` (`idcuti`, `jeniscuti`) VALUES
('CT001', 'Sakit'),
('CT002', 'Urusan Keluarga'),
('CT003', 'Lain-lain'),
('CT004', 'Cuti Tahunan'),
('CT005', 'Cuti Melahirkan');

CREATE TABLE IF NOT EXISTS `karyawan` (
  `nik` varchar(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `divisi` varchar(30) NOT NULL,
  `level` varchar(20) NOT NULL,
  `sisacuti` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`nik`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `karyawan` (`nik`, `nama`, `divisi`, `level`, `sisacuti`) VALUES
('333222', 'Barkah', 'FSO', 'Staff', 12),
('000001', 'Amelia Silva', 'Direktur', 'Direktur', 12),
('000111', 'Asep', 'IT', 'Staff', 12),
('222111', 'Silva', 'HRD', 'Manager', 12),
('333111', 'John Jay', 'FSO', 'Manager', 12),
('123123', 'Ismail', 'IT', 'Manager', 12),
('111000', 'Taufik', 'IT', 'General Manager', 12),
('123321', 'Ojes', 'FSO', 'General Manager', 12);

CREATE TABLE IF NOT EXISTS `pengajuancuti` (
  `idpengajuancuti` varchar(10) NOT NULL,
  `nik` varchar(12) NOT NULL,
  `idcuti` varchar(10) NOT NULL,
  `tanggalpengajuan` date NOT NULL,
  `tanggalmulai` date NOT NULL,
  `lamacuti` int(11) NOT NULL,
  `alasancuti` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`idpengajuancuti`),
  KEY `nik` (`nik`),
  KEY `idcuti` (`idcuti`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `pengajuancuti` (`idpengajuancuti`, `nik`, `idcuti`, `tanggalpengajuan`, `tanggalmulai`, `lamacuti`, `alasancuti`, `status`) VALUES
('PC001', '111000', 'CT002', '2026-06-20', '2026-06-30', 2, 'Urusan Keluarga', 'Pending'),
('PC002', '000111', 'CT004', '2026-06-22', '2026-07-01', 3, 'Cuti Tahunan', 'Approve'),
('PC003', '333222', 'CT001', '2026-06-23', '2026-07-02', 1, 'Sakit', 'Success');

INSERT INTO `approvecuti` (`idapprovecuti`, `idpengajuancuti`, `tanggalapprove`, `approveby`) VALUES
('AP001', 'PC002', '2026-06-24', 'Administrator');

CREATE TABLE IF NOT EXISTS `userlogin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `userlogin` (`username`, `password`) VALUES
('admin', 'admin'),
('111000', '654321'),
('123123', '123456'),
('000111', '123456'),
('222111', '123456'),
('333111', '123456'),
('333222', '123456'),
('000001', '123456'),
('123321', '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
