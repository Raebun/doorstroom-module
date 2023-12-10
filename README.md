# Cookbook

Users need an easy way to create, edit, and delete their recipes. Managing multiple recipes and ingredients can be overwhelming without a structured interface. To enable users to save and edit their recipes, a secure user authentication system is required to manage. On top of that, the website should work on various devices, including desktops, tablets and smartphones.

To address the above, the following solution has been proposed:
•	Implement a user-friendly recipe creation and editing interface with fields for title, ingredients, preparation steps, and optional images.
•	Provide a user dashboard where users can manage their recipes, including editing and deleting them.
•	Implement a secure user registration and login system
•	Develop a responsive design that adapts to different screen sizes and devices


## Getting Started

These instructions will help you get a copy of the project up and running on your local machine.

### Prerequisites

Make sure you have the following software installed on your machine:

- [Git](https://git-scm.com/)
- [XAMPP](https://www.apachefriends.org/index.html)

### Cloning the Repository

1. Open your terminal or command prompt.

2. Change the current working directory to the location where you want to clone the project.

    ```bash
    cd path/to/your/directory
    ```

3. Clone the repository by running the following command:

    ```bash
    git clone https://github.com/Raebun/doorstroom-module.git
    ```

### Setting Up XAMPP

1. Install XAMPP by following the instructions on the [official XAMPP website](https://www.apachefriends.org/index.html).

2. Start the Apache server and MySQL from the XAMPP control panel.

### Importing the Database

1. Open your web browser and navigate to `http://localhost/phpmyadmin`.

2. In the phpMyAdmin dashboard, create a new database with the name `cookbook`

3. Select the newly created database from the left-hand sidebar.

4. Click on the "Import" tab in the top navigation menu.

5. Click on the "Choose File" button and select the SQL file `database.sql` from the project's directory.

6. Click the "Import" button to import the database structure and data.

### Configuring the Project

1. Navigate to the project directory that you cloned.

    ```bash
    cd your-repository
    ```

2. Copy the project files into the `htdocs` directory of your XAMPP installation.

### Running the Project

1. Open your web browser and navigate to `http://localhost/name-of-project-folder`.

2. The project should now be running, and you can interact with it through your web browser.
