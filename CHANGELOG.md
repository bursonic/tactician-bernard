# Change Log


## 0.3.0 - 2015-03-30

### Changed

- The `Command` interface from Tactician is no longer required

### Removed

- `QueueableCommand` interface is not needed anymore


## 0.2.0 - 2015-03-17

### Added

- `*BusReceivers` to be added to Bernard's core routers

### Changed

- Use a `Producer` instead of a specific `Queue` (queue name can be guessed from the command)

### Removed

- Custom `Router` implementation


## 0.1.0 - 2015-02-19

### Added

- Initial release
