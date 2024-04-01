-- Create the 'database' Table
CREATE TABLE [dbo].[database](
    [id] [int] NOT NULL,
      NULL,
      NULL,
      NULL,
 CONSTRAINT [PK_database] PRIMARY KEY CLUSTERED 
(
    [id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

-- Add the 'role_id' Column to the 'database' Table
ALTER TABLE [dbo].[database]
ADD [role_id] INT;
GO

-- Create the 'roles' Table
CREATE TABLE [dbo].[roles] (
    [id] INT PRIMARY KEY,
    [role_name] NVARCHAR(50)
);
GO

-- Insert Roles into the 'roles' Table
INSERT INTO [dbo].[roles] ([id], [role_name]) VALUES
(1, 'teacher'),
(2, 'student'),
(3, 'faculty');
GO

-- Update the 'role_id' Column in the 'database' Table
UPDATE [dbo].[database] SET [role_id] = 1 WHERE [role] = 'teacher';
UPDATE [dbo].[database] SET [role_id] = 2 WHERE [role] = 'student';
UPDATE [dbo].[database] SET [role_id] = 3 WHERE [role] = 'faculty';
GO

-- Remove the 'role' Column from the 'database' Table
ALTER TABLE [dbo].[database]
DROP COLUMN [role];
GO
