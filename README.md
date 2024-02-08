# PHP CSV Upload and MySQL Database Population with PDO and AJAX

This PHP script provides a straightforward method to upload CSV files into a MySQL database using PDO (PHP Data Objects) for database interaction and AJAX for asynchronous communication with the server. Additionally, it offers the functionality to map CSV columns to specific database table columns, providing flexibility and customization.

## Prerequisites

- PHP installed on your server (version 7.x recommended)
- MySQL database server
- Basic knowledge of PHP, MySQL, HTML, and JavaScript

## Features

- Upload CSV files using a web interface
- Map CSV columns to corresponding database table columns
- Populate MySQL database with CSV data
- Display feedback messages using AJAX

## Installation

1. Clone or download the repository to your server.
2. Configure your database connection settings in `config.php`.
3. Ensure the `uploads` directory has appropriate permissions for file uploads.

## Usage

1. Navigate to the project directory in your web browser.
2. Click on the "Upload CSV" button.
3. Choose a CSV file from your local system.
4. Map CSV columns to corresponding database table columns.
5. Click "Upload" to import data into the database.
6. Upon successful upload, you will receive a confirmation message.

## File Structure

- **index.php**: Contains HTML markup for the upload form and JavaScript for AJAX requests.
- **upload.php**: Handles file upload, CSV parsing, column mapping, and database insertion.
- **config.php**: Stores database configuration settings.
- **uploads/**: Directory to store uploaded CSV files.
- **assets/**: Directory for CSS and JavaScript files (if any).

## Configuration

- Modify `config.php` to set your database connection parameters.
- Adjust the database table name and structure to match your requirements in `upload.php`.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- This project utilizes the power of PHP, PDO, AJAX, and MySQL.
- Inspired by the need for a simple and efficient CSV upload solution.

## Support

For any issues or questions, please open an issue in the GitHub repository.

---

Feel free to contribute, suggest improvements, or report issues! Your feedback is valuable.
