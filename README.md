# interconnecThor

![Logo](https://chatter-calcium-c6a.notion.site/image/https%3A%2F%2Fs3-us-west-2.amazonaws.com%2Fsecure.notion-static.com%2F0b50f63a-0354-43ea-815f-be77f1ad2d28%2Flogo.png?id=a84c8cbc-2694-4988-9811-e1fd2135a6b0&table=block&spaceId=50d8163f-6c27-4ed8-94e7-e16b63ae1dae&width=1000&userId=&cache=v2)

**interconnecThor** is a unique social media networking platform exclusively designed for the students of SyntraPXL. Our platform serves as a hub where students can connect, share ideas, and transform their innovative thoughts into meaningful projects.

## Table of Contents

- [About Us](#about-us)
- [Features](#features)
- [FAQ](#faq)
- [Support](#support)
- [Contributing](#contributing)
- [Instructions](#instructions)
  - [Chat Configuration](#chat-configuration)
  - [Meet Configuration](#meet-configuration)
- [Instructions for Admin Setup](#instructions-for-admin-setup)
- [Important Note: User Approval](#important-note-user-approval)
  - [Method 1: Database Approval](#method-1-database-approval)
  - [Method 2: Admin Approval](#method-2-admin-approval)

## About Us

We are "The Incognito’s", a dynamic team composed of Alex, Milan, and Remco. Our journey began at SyntraPXL, nestled within the inspiring surroundings of Thor Park, Genk. Inspired by the vibrant energy and the spirit of innovation synonymous with our location, we set out to create a platform that mirrors these values – leading to the birth of interconnecThor.

interconnecThor, a nod to our geographical roots and a symbol of connection, is a unique digital platform built using the robust Laravel framework. Designed specifically for the students of SyntraPXL, it's a hub where ideas meet implementation, where students can connect, share, and transform their innovative ideas into meaningful projects or seize exciting job opportunities.

## Features

- Personalized profiles: Create your unique profile and start connecting with your peers.
- Posts: Share your thoughts, ideas and interact with the posts made by others.
- Connection system: Connect with other users and get connected.
- Likes: Like the posts that resonate with you and comment on them for wider reach.
- Chat: Realtime chat with your connections, send text messages, stickers, GIFs & Images, view user status online / offline / last seen and notifications on new message.
- Virtual meetings: Start a groupmeeting and collaborate with your connnections on innovative ideas.
- Screen sharing: Share your screen during meetings, enhancing the collaboration experience.

## FAQ

**Q: Who can use interconnecThor?**
A: interconnecThor is exclusively designed for the students of SyntraPXL.

**Q: How do I register on interconnecThor?**
A: You can register using your email address. After registration, a school admin will need to approve your account before you can start using the platform.

**Q: Can I share my ideas or projects on interconnecThor?**
A: Yes, interconnecThor is designed as a hub where students can share ideas, collaborate on projects, and discover job opportunities.

**Q: How does the virtual meeting and screen sharing feature work?**
A: You can start a virtual meeting with any of your connections on the platform. The screen sharing feature allows you to share your screen during these meetings, which can be very helpful when working together on projects.

**Q: Is my data safe on interconnecThor?**
A: Yes, we take data security very seriously. All your personal information is kept secure, and we don't share your data with third parties.

## Support

For any queries, issues, or support, you can reach out to us via the contact form on our website. We are always here to help you!

## Contributing

We welcome contributions from the SyntraPXL student community. Feel free to fork the repository and submit a pull request. For major changes, please open an issue first to discuss what you would like to change.

## Instructions

To set up the project, follow these steps:

1. Clone the repository:
   ```
   git clone [repository URL]
   ```

2. Create a `.env` file in the project root and configure it with your environment settings.

3. Create and connect a database to the project.

4. Install the project dependencies using Composer:
   ```
   composer install
   ```

5. Generate an application key:
   ```
   php artisan key:generate
   ```

6. Run the database migrations to set up the required tables:
   ```
   php artisan migrate
   ```

7. Create a symbolic link to make the storage directory accessible:
   ```
   php artisan storage:link
   ```

8. Start the development server:
   ```
   php artisan serve
   ```

### Chat Configuration

To enable chat functionality, you need to set up a free Pusher account:

1. Create a Pusher account at [https://dashboard.pusher.com](https://dashboard.pusher.com).

2. Go to "App Keys" and add the obtained credentials to your `.env` file:
   ```
   PUSHER_APP_ID=[your Pusher app ID]
   PUSHER_APP_KEY=[your Pusher app key]
   PUSHER_APP_SECRET=[your Pusher app secret]
   PUSHER_APP_CLUSTER=[your Pusher app cluster]
   ```

Change `BROADCAST_DRIVER=log` to `BROADCAST_DRIVER=pusher` in the `.env` file:

The `BROADCAST_DRIVER` configuration determines the driver used for broadcasting events in your Laravel application. By changing this setting to `pusher`, you can utilize the Pusher service for real-time communication. Make sure you have the required Pusher configuration details set in the `.env` file, such as the Pusher app ID, key, and secret.

Refer to the Laravel and Pusher documentation for more information on configuring real-time communication with Pusher.



### Meet Configuration

To enable meet functionality, you need to set up a free Metered account:

1. Create a Metered account at [https://dashboard.metered.ca/signup](https://dashboard.metered.ca/signup).

2. Go to "Developers" and copy your Metered domain and secret key.

3. Replace the placeholders in the `.env` file with your Metered domain and secret key:
   ```
   METERED_DOMAIN="[your Metered domain]"
   METERED_SECRET_KEY="[your Metered secret key]"
   ```

Make sure to add the `METERED_DOMAIN` and `METERED_SECRET_KEY` variables to your `.env` file.

Now you should have the necessary configurations in place to run the project successfully.

## Instructions for Admin Setup

To set up an admin user using Laravel Voyager, follow these steps:

1. Open your command line or terminal.

2. Run the following command to install Laravel Voyager:
   ```
   php artisan voyager:install
   ```

   This command will publish the Voyager assets, configurations, and create necessary database tables.

3. After installing Voyager, run the following command to create an admin user:
   ```
   php artisan voyager:admin your_email@example.com --create
   ```

   Replace `your_email@example.com` with the desired email address for the admin user.

4. You will be prompted to enter the admin user's name and password. Provide the necessary details and press Enter.

5. Laravel Voyager will create the admin user with the specified email address and credentials.

Now you can use the admin credentials to log in to your Laravel Voyager dashboard and manage your application.

## Important Note: User Approval

Please note that user approval is required for users to be able to log in to the system. By default, newly created users have an approval status of 0, which means they are not approved.

To approve a user and allow them to log in, follow one of the following methods:

### Method 1: Database Approval

1. In the `users` table of your database, locate the user you want to approve.
2. Set the `approved` column value for that user to 1.
3. Save the changes.

### Method 2: Admin Approval

1. Log in to the admin section of your application using your admin account.
2. Go to the user management section or user list.
3. Find the user you want to approve.
4. Edit the user details and set the approval status to approved.
5. Save the changes.

Once a user is approved, they will be able to log in using their credentials. It is important to ensure that users are approved to prevent unauthorized access to the system.

Please make sure to follow the appropriate approval method to grant access to new users.