# Define variables
$taskName = "Run My Symfony Command"
$command = "C:\xampp\php\php.exe"
$arguments = "C:\Users\ilyes\Documents\GitHub\PIDEV_OKAMI\bin\console app:rendez-vous-reminder"
$workingDirectory = "C:\Users\ilyes\Documents\GitHub\PIDEV_OKAMI\"
$triggerType = "Daily"
$triggerTime = "04:00"
$triggerInterval = "1"
$triggerDaysOfWeek = "Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday"

# Create a new scheduled task
$taskAction = New-ScheduledTaskAction -Execute $command -Argument $arguments -WorkingDirectory $workingDirectory
$taskTrigger = New-ScheduledTaskTrigger -Daily -At $triggerTime -DaysOfWeek $triggerDaysOfWeek -WeeksInterval $triggerInterval
$taskSettings = New-ScheduledTaskSettingsSet
Register-ScheduledTask -TaskName $taskName -Action $taskAction -Trigger $taskTrigger -Settings $taskSettings