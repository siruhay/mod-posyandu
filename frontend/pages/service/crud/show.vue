<template>
	<form-show with-helpdesk>
		<template v-slot:default="{ record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-text-field
							label="Name"
							v-model="record.name"
							readonly
						></v-text-field>
					</v-col>
				</v-row>
			</v-card-text>

			<div class="text-overline px-4">dokumen</div>
			<v-divider></v-divider>

			<!-- <v-card-text> -->
			<v-table density="compact">
				<thead>
					<tr>
						<th>Dokumen</th>
						<th>Size</th>
						<th>Req</th>
					</tr>
				</thead>

				<tbody>
					<tr v-for="(document, index) in record.docmaps" :key="index">
						<td>{{ document.name }}</td>
						<td>{{ document.maxsize }}</td>
						<td>
							<v-checkbox-btn
								v-model="document.required"
								:ripple="false"
								disabled
							></v-checkbox-btn>
						</td>
					</tr>
				</tbody>
			</v-table>
			<!-- </v-card-text> -->
		</template>

		<template v-slot:helpdesk></template>
	</form-show>
</template>

<script>
export default {
	name: "posyandu-service-show",
};
</script>
