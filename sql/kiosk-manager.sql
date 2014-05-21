-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2014 at 11:49 PM
-- Server version: 5.5.37
-- PHP Version: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `app`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkUser`(varUser varchar(255))
BEGIN
SELECT role FROM authorized_users WHERE username = varUser;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllCurrentSettings`()
BEGIN
SELECT k.iPadID, k.description, k.building, k.roomLocation, ka.description AS applicationDescription, ka.homePage, ks.*
FROM kiosk k
LEFT OUTER JOIN kiosk_setting ks ON k.kiosk_id = ks.kiosk_id
LEFT OUTER JOIN application ka ON ks.application_id = ka.application_id
INNER JOIN (
        SELECT MAX(kiosk_setting_id) as maxid FROM kiosk_setting   
        WHERE   activeTime <= NOW() GROUP BY kiosk_id 
        ) as ks ON k.kiosk_id = ks.kiosk_id
WHERE ks.kiosk_setting_id in (maxid)
ORDER BY kiosk_setting_id asc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllKiosks`()
BEGIN
SELECT * 
FROM kiosk
ORDER BY building, roomLocation;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getApplications`()
BEGIN
SELECT *
FROM application;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getCurrentSettings`(varIPadID varchar(255))
BEGIN
SELECT k.iPadID AS 'uniqueiPadID', 
	a.homePage, 
	a.whiteList, 
	a.idleTime,
	a.refreshTime,
	a.showStatusBar, 
	a.showAddressBar, 
	a.showNavigationBar, 
	a.zoomDisabled, 
	a.printEnabled, 
	a.showLoadingProgress,
	a.viewOnly, 
	a.browseTime, 
	a.goodByePage, 
	a.showSiteMessage, 
	a.offDomainMessage,
	a.accessJS_API,
	k.emailOnPower,
	k.smtpFromEmail, 
	k.smtpToEmail, 
	k.smtpServer, 
	k.smtpRequiresAuth, 
	k.smtpUserName, 
	k.smtpPassword,
	k.smtpEnableSSL, 
	k.remoteSettingsEnabled, 
	k.externalSettingsFile, 
	a.customLinksEnabled,
	a.navBarIconsColorScheme,
	a.navBarBackgroundColor,
	a.clButtonBackgroundColor,
	a.clBackgroundColor, 
	a.clLabel1, 
	a.clLink1, 
	a.clLabel2, 
	a.clLink2, 
	a.clLabel3, 
	a.clLink3,
	a.clLabel4, 
	a.clLink4, 
	a.clLabel5, 
	a.clLink5, 
	a.clLabel6, 
	a.clLink6, 
	ks.kiosk_setting_id, 
	k.settingsShowingOption, 
	k.settingsPassCode,
	k.showConnectionProblemPage, 
	k.customConnectionProblemPage, 
	k.localSettingsUpdatePeriod, 
	k.smtpPorts, 
	k.emailOnPower, 
	k.emailOnRemoteSettingsChange, 
	a.manualControlOfBrightness, 
	a.textSelection, 
	a.disableWebViewBouncing, 
	a.pageReloadBackgroundColor,
	a.blackList, 
	a.pageLoadTime, 
	a.pdfShowThumbs, 
	a.pdfShowPageNumbers,
	a.pdfDisableZoom,
	a.pdfScrollingType, 
	a.pdfInfiniteScrollOrientation, 
	a.pdfBackgroundImageFile, 
	a.clearCache, 
	a.cookieAcceptPolicy, 
	a.clearCookies, 
	a.showPrintIcon,
	k._kp_disableTelLinks_,
	k._kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_
FROM kiosk_setting ks
  INNER JOIN application a ON ks.application_id = a.application_id
  INNER JOIN kiosk k ON ks.kiosk_id = k.kiosk_id 
WHERE k.iPadID = varIPadID AND ks.activeTime <= NOW()
ORDER BY ks.activeTime DESC
LIMIT 0,1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUsers`()
BEGIN
SELECT * 
FROM authorized_users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `write_settings_from_schedule`()
BEGIN
  INSERT INTO kiosk_setting(kiosk_id, application_id, dateCreated, dateModified, modifiedBy, activeTime, kiosk_application_schedule_id)
  SELECT 
	kas.kiosk_id, 
	kas.application_id, 
	NOW() AS dateCreated, 
	NOW() AS dateModified, 
	'mysql schedule routine' AS modifiedBy, 
	CASE 
		WHEN hour = 24 
		THEN CONCAT(CURDATE(), ' ', MAKETIME(0,minute,0)) 
		ELSE CONCAT(CURDATE(), ' ', MAKETIME(hour,minute,0)) 
	END as activeTime,  
	kas.kiosk_application_schedule_id
FROM kiosk_application_schedule kas
WHERE
   
   -- Daily Schedules Match 
   (TIMEDIFF(MAKETIME(hour,minute,0), CURTIME()) > MAKETIME(0,4,0) 
   AND 
   TIMEDIFF(MAKETIME(hour,minute,0), CURTIME()) < MAKETIME(0,10,0)
   AND 
   frequency = 'd')

   OR
   
   -- Weekly Schedules Match
   (TIMEDIFF(MAKETIME(hour,minute,0), CURTIME()) > MAKETIME(0,4,0) 
   AND 
   TIMEDIFF(MAKETIME(hour,minute,0), CURTIME()) < MAKETIME(0,10,0)
   AND 
   frequency = 'w'
   AND
   day = DAYOFWEEK(CURDATE())
   )

OR

   -- Monthly Schedules Match
   (TIMEDIFF(MAKETIME(hour,minute,0), CURTIME()) > MAKETIME(0,4,0) 
   AND 
   TIMEDIFF(MAKETIME(hour,minute,0), CURTIME()) < MAKETIME(0,10,0)
   AND 
   frequency = 'm'
   AND
   date = DAY(CURDATE())
   )

OR

   -- Yearly Schedules Match
   (TIMEDIFF(MAKETIME(hour,minute,0), CURTIME()) > MAKETIME(0,4,0) 
   AND 
   TIMEDIFF(MAKETIME(hour,minute,0), CURTIME()) < MAKETIME(0,10,0)
   AND 
   frequency = 'y'
   AND
   date = DAY(CURDATE())
   AND
   month = MONTH(CURDATE())
   );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `homePage` varchar(255) DEFAULT NULL,
  `description` text,
  `whiteList` varchar(500) DEFAULT 'woodmenvalley.org',
  `idleTime` varchar(255) DEFAULT '45',
  `refreshTime` int(11) NOT NULL DEFAULT '0' COMMENT '(minutes) 0 = Never',
  `showStatusBar` tinyint(4) DEFAULT '0',
  `showAddressBar` tinyint(4) DEFAULT '0',
  `showNavigationBar` tinyint(4) DEFAULT '0',
  `zoomDisabled` tinyint(4) DEFAULT '0',
  `printEnabled` tinyint(4) DEFAULT '0',
  `showLoadingProgress` tinyint(4) DEFAULT '1',
  `viewOnly` tinyint(4) DEFAULT '0',
  `browseTime` int(11) DEFAULT '-1',
  `goodByePage` varchar(255) DEFAULT NULL,
  `showSiteMessage` tinyint(4) DEFAULT '0',
  `offDomainMessage` text COMMENT '	',
  `customLinksEnabled` tinyint(4) DEFAULT '0',
  `navBarIconsColorScheme` int(11) NOT NULL COMMENT '(0= Red, 1 = Yellow, 2 = Green, 3 = Blue, 4 = Light Gray, 5 = Dark Gray, 6 = Black, 7 = White)',
  `navBarBackgroundColor` varchar(45) NOT NULL COMMENT 'RGB Format eg. 84,84,84',
  `clBackgroundColor` varchar(45) DEFAULT NULL COMMENT '	',
  `clButtonBackgroundColor` varchar(45) NOT NULL,
  `clLabel1` varchar(45) DEFAULT NULL,
  `clLink1` varchar(45) DEFAULT NULL COMMENT '		',
  `clLabel2` varchar(45) DEFAULT NULL,
  `clLink2` varchar(45) DEFAULT NULL,
  `clLabel3` varchar(45) DEFAULT NULL,
  `clLink3` varchar(45) DEFAULT NULL,
  `clLabel4` varchar(45) DEFAULT NULL,
  `clLink4` varchar(45) DEFAULT NULL,
  `clLabel5` varchar(45) DEFAULT NULL,
  `clLink5` varchar(45) DEFAULT NULL,
  `clLabel6` varchar(45) DEFAULT NULL,
  `clLink6` varchar(45) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` timestamp NULL DEFAULT NULL,
  `modifiedBy` varchar(45) DEFAULT NULL,
  `textSelection` tinyint(4) NOT NULL,
  `disableWebViewBouncing` tinyint(4) NOT NULL,
  `pageReloadBackgroundColor` varchar(50) NOT NULL,
  `blackList` varchar(500) NOT NULL,
  `pageLoadTime` varchar(10) NOT NULL,
  `pdfShowThumbs` tinyint(4) NOT NULL,
  `pdfShowPageNumbers` tinyint(4) NOT NULL,
  `pdfDisableZoom` tinyint(4) NOT NULL,
  `pdfScrollingType` tinyint(4) NOT NULL,
  `pdfInfiniteScrollOrientation` tinyint(4) NOT NULL,
  `pdfBackgroundImageFile` varchar(255) NOT NULL,
  `clearCache` tinyint(4) NOT NULL,
  `cookieAcceptPolicy` tinyint(4) NOT NULL,
  `clearCookies` tinyint(4) NOT NULL,
  `showPrintIcon` tinyint(4) NOT NULL,
  `manualControlOfBrightness` double NOT NULL DEFAULT '1',
  `accessJS_API` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Triggers `application`
--
DROP TRIGGER IF EXISTS `ins_application`;
DELIMITER //
CREATE TRIGGER `ins_application` BEFORE INSERT ON `application`
 FOR EACH ROW BEGIN
	IF(LENGTH(NEW.clBackgroundColor) != 0) THEN 
		SET NEW.clButtonBackgroundColor = NEW.clBackgroundColor;
	ELSEIF(LENGTH(NEW.clButtonBackgroundColor) != 0) THEN
		SET NEW.clBackgroundColor = NEW.clButtonBackgroundColor;
	END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `upd_application`;
DELIMITER //
CREATE TRIGGER `upd_application` BEFORE UPDATE ON `application`
 FOR EACH ROW BEGIN
	IF(LENGTH(NEW.clBackgroundColor) != 0) THEN 
		SET NEW.clButtonBackgroundColor = NEW.clBackgroundColor;
	ELSEIF(LENGTH(NEW.clButtonBackgroundColor) != 0) THEN
		SET NEW.clBackgroundColor = NEW.clButtonBackgroundColor;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `authorized_users`
--

CREATE TABLE IF NOT EXISTS `authorized_users` (
  `authorized_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `role` varchar(45) NOT NULL COMMENT 'k = manage kiosks; p = manage applications; s = manage kiosk settings; d = manage schedule; u = manage users',
  `dateModified` date NOT NULL,
  `modifiedBy` varchar(45) NOT NULL,
  PRIMARY KEY (`authorized_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `kiosk`
--

CREATE TABLE IF NOT EXISTS `kiosk` (
  `kiosk_id` int(11) NOT NULL AUTO_INCREMENT,
  `iPadID` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `roomLocation` varchar(255) DEFAULT NULL,
  `emailOnPower` tinyint(4) DEFAULT '1',
  `smtpFromEmail` varchar(45) DEFAULT 'kiosk@woodmenvalley.org',
  `smtpToEmail` varchar(45) DEFAULT 'helpdesk@woodmenvalley.org',
  `smtpServer` varchar(45) DEFAULT 'mail.woodmenvalley.org',
  `smtpRequiresAuth` tinyint(4) DEFAULT '1',
  `smtpUserName` varchar(45) DEFAULT 'kiosk',
  `smtpPassword` varchar(45) DEFAULT 'kiosk',
  `smtpEnableSSL` tinyint(4) DEFAULT '1',
  `remoteSettingsEnabled` tinyint(4) DEFAULT '1',
  `externalSettingsFile` varchar(255) DEFAULT 'http://app.woodmenvalley.org/kiosk/',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedBy` varchar(45) DEFAULT NULL,
  `settingsShowingOption` int(11) NOT NULL,
  `settingsPassCode` varchar(255) NOT NULL,
  `showConnectionProblemPage` int(11) NOT NULL DEFAULT '0',
  `customConnectionProblemPage` varchar(255) NOT NULL,
  `localSettingsUpdatePeriod` varchar(10) NOT NULL,
  `smtpPorts` varchar(15) NOT NULL,
  `emailOnRemoteSettingsChange` int(11) NOT NULL,
  `manualControlOfBrightness` double NOT NULL,
  `_kp_disableTelLinks_` tinyint(4) NOT NULL,
  `_kp_disableDefaultCalloutShownWhenTouchAndHoldTarget_` tinyint(4) NOT NULL,
  PRIMARY KEY (`kiosk_id`),
  KEY `idx_roomLocation` (`roomLocation`),
  KEY `idx_iPadID` (`iPadID`),
  KEY `idx_building` (`building`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

-- --------------------------------------------------------

--
-- Table structure for table `kiosk_application_schedule`
--

CREATE TABLE IF NOT EXISTS `kiosk_application_schedule` (
  `kiosk_application_schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `createdBy` varchar(30) DEFAULT NULL,
  `modifiedBy` varchar(30) DEFAULT NULL,
  `createTimestamp` timestamp NULL DEFAULT NULL,
  `modifiedTimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `kiosk_id` int(11) DEFAULT NULL,
  `application_id` int(11) DEFAULT NULL,
  `frequency` varchar(1) DEFAULT NULL COMMENT 'D=Daily, W=Weekly, M=Monthly, Q=Quarterly, Y=Yearly',
  `month` int(11) DEFAULT NULL COMMENT '1=Jan, 2=Feb, 3=Mar, 4=Apr, 5=May, 6=Jun, 7=Jul, 8=Aug, 9=Sep, 20=Oct, 11=Nov, 12=Dec',
  `day` int(11) DEFAULT NULL COMMENT '1=Sun, 2=Mon, 3=Tue, 4=Wed, 5=Thu, 6=Fri, 7=Sat',
  `date` int(11) DEFAULT NULL COMMENT 'day of the month',
  `hour` int(11) NOT NULL DEFAULT '24' COMMENT '24 Hour (24=midnight, 12=noon, 23=11pm)',
  `minute` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kiosk_application_schedule_id`),
  KEY `idx_frequency` (`frequency`),
  KEY `idx_day` (`day`),
  KEY `idx_date` (`date`),
  KEY `idx_hour` (`hour`),
  KEY `idx_minute` (`minute`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=414 ;

--
-- RELATIONS FOR TABLE `kiosk_application_schedule`:
--   `application_id`
--       `application` -> `application_id`
--   `kiosk_id`
--       `kiosk` -> `kiosk_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `kiosk_group`
--

CREATE TABLE IF NOT EXISTS `kiosk_group` (
  `kiosk_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `kiosk_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`kiosk_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- RELATIONS FOR TABLE `kiosk_group`:
--   `group_id`
--       `group` -> `group_id`
--   `kiosk_id`
--       `kiosk` -> `kiosk_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `kiosk_setting`
--

CREATE TABLE IF NOT EXISTS `kiosk_setting` (
  `kiosk_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `kiosk_id` int(11) DEFAULT NULL,
  `application_id` int(11) DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateModified` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `modifiedBy` varchar(255) DEFAULT NULL,
  `activeTime` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `kiosk_application_schedule_id` int(4) DEFAULT '0',
  PRIMARY KEY (`kiosk_setting_id`),
  KEY `idx_dateModified` (`dateModified`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18528 ;

--
-- RELATIONS FOR TABLE `kiosk_setting`:
--   `application_id`
--       `application` -> `application_id`
--   `kiosk_id`
--       `kiosk` -> `kiosk_id`
--

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `write_schedule_settings` ON SCHEDULE EVERY 5 MINUTE STARTS '2013-09-10 16:00:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL write_settings_from_schedule()$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
