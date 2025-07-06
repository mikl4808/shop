# cart

A minimal TYPO3 extension providing a basic shopping cart and order service. It allows you to add items with a quantity and price to a cart and to calculate the final order total.

## Dependencies

- **PHP** `>=8.1`
- **Composer** for dependency management
- **TYPO3 CMS** `^12.4` or `^13.0`
- **PHPUnit** `^12.2` (for running the unit tests)
- **Xdebug** (optional, for code coverage reports)

## Installation

1. Install the extension through Composer:
   ```bash
   composer require mircokl/shop
   ```
2. Activate the extension in the TYPO3 Extension Manager.
3. Run the unit tests to verify everything works:
   ```bash
   XDEBUG_MODE=coverage vendor/bin/phpunit --testdox
   ```

## Features

- Add items to a cart with quantity and price
- Calculate totals for all items
- Remove items from the cart
- Service for computing final price with optional discount

## Planned Improvements

- Persist cart contents between requests
- Integrate with TYPO3 frontend plugins
- Support for multiple currencies and tax rates

=======

