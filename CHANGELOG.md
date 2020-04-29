# Changelog

## [1.4.2] - 2020-04-29
### FIXED
- ContainerClient - wrong Parameter for Create (#98)

## [1.4.1] - 2020-02-26
### Changed
- Enable NoStrictKeys Hydrator Config (#85)

## [1.4.0] - 2020-02-13
### Added
- Missing Test for createMilestoneClient #71

### Changed
- Split up documentation #70

### Fixed
- Fix Typo WorkflowClient #73
- Fix Github Workflow #75

## [1.3.0] - 2019-12-11
### Added
- Support for new milestone related methods in ProfileClient #62
- Add MilestoneClient to support the new milestone object #61

### Fixed
- Internal beautifications #57

## [1.2.0] - 2019-03-15
### Added
- Add PoolClient/deleteAttribute to delete Pool Attributes #45

### Changed
- Update PHPUnit

### Fixed
-  Documentation #46

## [1.1.2] - 2019-01-30
### Fixed
- Parameter count and naming of `createConfigured` was wrong #42

## [1.1.1] - 2019-01-29
### Fixed
- Rename results for workflow methods export and createConfigured #37

## [1.1.0] - 2019-01-29
### Added
- Add ProfileClient/getTrackingHistory to retrieve the tracking history of a
  single profile #24
- Add methods to the workflow client to export/import workflow configurations
  #28

### Fixed
- JobHandleConfig did not use the correct setter/getter methods #30

## [1.0.0] - 2018-10-01
### Changed
- Official release

## [0.1.8] - 2018-09-29
### Changed
- Update Dependency Hydrator v2

## [0.1.7] - 2018-09-10
### Changed
- Renamed FolderClient/getSubCategories to getSubFolderById

## [0.1.6] - 2018-09-05
### Added
- Changelog added

### Changed
- Documentation updates
- Clarify wording of API Methods / Parameter
- Fixate the struct version to new Version

## [0.1.5] - 2018-09-05
### Changed
- Documentation updates
- Fixate the struct version temporary

## [0.1.4] - 2018-08-27
### Added
- Add the possibility Hydrator Getter can return null values

### Fixed
- Extractor removes '' values from array

## [0.1.3] - 2018-08-27
### Changed 
- Streamline update-/merge method names in the profile client

### Fixed
- Error MassUpdateResultConfig Extractor/Hydrator Properties

## [0.1.2] - 2018-08-24
### Changed 
- Update struct version constraint

## [0.1.1] - 2018-08-24
### Changed 
- Bump struct version to 0.1
