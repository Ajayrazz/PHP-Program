<?php
// Robot state
$robot = [
    'position' => ['x' => 0, 'y' => 0],
    'direction' => 'north' // initial facing
];

// Function to update robot state by reference
function updateRobotState(&$robot, $command) {
    $directions = ['north', 'east', 'south', 'west'];

    switch (strtolower($command)) {
        case 'move forward':
            switch ($robot['direction']) {
                case 'north':
                    $robot['position']['y'] += 1;
                    break;
                case 'south':
                    $robot['position']['y'] -= 1;
                    break;
                case 'east':
                    $robot['position']['x'] += 1;
                    break;
                case 'west':
                    $robot['position']['x'] -= 1;
                    break;
            }
            break;

        case 'turn left':
            $currentIndex = array_search($robot['direction'], $directions);
            // Turning left means going counter-clockwise
            $newIndex = ($currentIndex - 1 + 4) % 4;
            $robot['direction'] = $directions[$newIndex];
            break;

        case 'turn right':
            $currentIndex = array_search($robot['direction'], $directions);
            // Turning right means going clockwise
            $newIndex = ($currentIndex + 1) % 4;
            $robot['direction'] = $directions[$newIndex];
            break;

        default:
            echo "Unknown command: $command\n";
    }
}

// Example movements
updateRobotState($robot, 'move forward');
updateRobotState($robot, 'turn right');
updateRobotState($robot, 'move forward');
updateRobotState($robot, 'turn left');
updateRobotState($robot, 'move forward');

// Display final robot state
echo "Final Robot State:\n";
echo "Position: (" . $robot['position']['x'] . ", " . $robot['position']['y'] . ")\n";
echo "Facing: " . $robot['direction'] . "\n";
?>
