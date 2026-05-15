#!/bin/bash

# Script directory and filename
SCRIPT_DIR="$(dirname "$0")"
SCRIPT_NAME="$(basename "$0")"

# Check for the required first argument
if [ -z "$1" ]; then
	echo "Usage: $0 New_Namespace"
	exit 1
fi

NEW_NAMESPACE="$1"

# Check for the optional translation domain argument and set it if provided
if [ -n "$2" ]; then
	TRANSLATION_DOMAIN="$2"
else
	echo "No translation domain provided. Skipping translation domain replacement."
fi

# Use find to get all files recursively from the script's directory, excluding the script itself
find "$SCRIPT_DIR" -type f \( -name "*.php" -o -name "*.json" \) ! -name "$SCRIPT_NAME" | while read -r file; do
	echo $file
	# Use perl for the replacement in each file
	perl -pi -e "s/WP_Compat_Validation_Tool/$NEW_NAMESPACE/g" "$file"
done

# If a new translation domain was provided, replace the old one with the new one
if [ -n "$TRANSLATION_DOMAIN" ]; then
	find "$SCRIPT_DIR" -type f \( -name "*.php" -o -name "*.json" \) ! -name "$SCRIPT_NAME" | while read -r file; do
		echo $file
		# Replace the exact string when surrounded by either single or double quotes
		perl -pi -e "s/(['\"])wp-compat-validation-tool\\1/$TRANSLATION_DOMAIN/g" "$file"
	done
fi

cd 10up-lib/wp-compat-validation-tool && rm -rf .git .github .gitignore composer.json composer.lock CHANGELOG.md CONTRIBUTING.md README.md LICENSE.md CODE_OF_CONDUCT.md CREDITS.md replace-namespace.sh
