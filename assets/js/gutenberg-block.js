// Import necessary components and hooks
const { registerBlockType } = wp.blocks;
const { SelectControl } = wp.components;
const { useState, useEffect } = wp.element;

// Define the block settings
const settings = {
    title: 'Business Profile',
    icon: 'admin-site',
    category: 'common',
    attributes: {
        option: {
            type: 'string',
            default: '--',
        },
    },

    // Edit function for the block
    edit: (props) => {
        const { attributes, setAttributes } = props;
        const { option } = attributes;
        const [options, setOptions] = useState([]);

        // Fetch options from the server when component mounts
        useEffect(() => {
            // Extract options from the server-provided data
            const businessProfileData = window.businessProfileData || {}; // Access data passed from PHP
            //const profileOptions = Object.keys(businessProfileData);

            const profileOptions = Object.entries(businessProfileData).map(([key, value]) => {
                return { label: key, value: value };
            });

            setOptions(profileOptions);
        }, []); // Run once when component mounts

        // Handler for option change
        const onChangeOption = (newOption) => {
            setAttributes({ option: newOption });
        };

        // Render the block in the editor
        return (
            <div>
                <SelectControl
                    label="Select which field you want to show"
                    value={option}
                    options={options.map(opt => ({ label: opt.label, value: opt.value }))}
                    onChange={onChangeOption}
                />
                <p>Preview:<br/> {option}</p>
            </div>
        );
    },

    // Save function for the block
    save: ({ attributes }) => {
        const { option } = attributes;
        return (
            <div>
                <p>{option}</p>
            </div>
        );
    },
};

// Register the block type with the defined settings
registerBlockType('business-profile-render/bpr-block', settings);
